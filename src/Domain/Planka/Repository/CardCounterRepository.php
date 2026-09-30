<?php

declare(strict_types=1);

namespace App\Domain\Planka\Repository;

use Symfony\Component\DependencyInjection\Attribute\Autowire;

/**
 * Compteur de cartes par projet Planka, persisté dans un fichier JSON « { projectId: dernierNuméro } ».
 *
 * Le fichier vit dans le share dir (partagé entre les releases Deployer) et fait foi : il doit suivre
 * le service en cas de changement de serveur. Chaque incrément se fait sous verrou exclusif (flock),
 * donc deux webhooks simultanés ne reçoivent jamais le même numéro.
 */
readonly class CardCounterRepository
{
    public function __construct(
        #[Autowire('%kernel.share_dir%/planka/card-counters.json')]
        private string $path,
    ) {
    }

    /**
     * Réserve et retourne le numéro suivant du projet.
     *
     * @param int $floor plus grand numéro déjà visible dans Planka : le compteur ne redescend jamais en dessous
     */
    public function next(string $projectId, int $floor = 0): int
    {
        return $this->withLock(function (array $counters) use ($projectId, $floor): array {
            $next = max($counters[$projectId] ?? 0, $floor) + 1;
            $counters[$projectId] = $next;

            return [$counters, $next];
        });
    }

    /**
     * Dernier numéro attribué au projet, sans rien réserver.
     */
    public function current(string $projectId, int $floor = 0): int
    {
        return $this->withLock(static fn (array $counters): array => [
            $counters,
            max($counters[$projectId] ?? 0, $floor),
        ]);
    }

    /**
     * @param \Closure(array<string, int>): array{array<string, int>, int} $operation
     */
    private function withLock(\Closure $operation): int
    {
        $directory = \dirname($this->path);
        if (!is_dir($directory) && !mkdir($directory, 0o775, true) && !is_dir($directory)) {
            throw new \RuntimeException(\sprintf('Unable to create directory "%s".', $directory));
        }

        $handle = fopen($this->path, 'c+');
        if (false === $handle) {
            throw new \RuntimeException(\sprintf('Unable to open counter file "%s".', $this->path));
        }

        try {
            if (!flock($handle, \LOCK_EX)) {
                throw new \RuntimeException(\sprintf('Unable to lock counter file "%s".', $this->path));
            }

            [$counters, $result] = $operation($this->read($handle));

            ftruncate($handle, 0);
            rewind($handle);
            fwrite($handle, json_encode($counters, \JSON_PRETTY_PRINT | \JSON_THROW_ON_ERROR) . "\n");
            fflush($handle);

            return $result;
        } finally {
            flock($handle, \LOCK_UN);
            fclose($handle);
        }
    }

    /**
     * @param resource $handle
     *
     * @return array<string, int>
     */
    private function read($handle): array
    {
        $content = stream_get_contents($handle);
        if (false === $content || '' === trim($content)) {
            return [];
        }

        $data = json_decode($content, true, flags: \JSON_THROW_ON_ERROR);
        if (!\is_array($data)) {
            throw new \RuntimeException(\sprintf('Counter file "%s" is not a JSON object.', $this->path));
        }

        $counters = [];
        foreach ($data as $projectId => $value) {
            if (!\is_int($value)) {
                throw new \RuntimeException(\sprintf('Counter of project "%s" is not an integer.', $projectId));
            }
            $counters[(string) $projectId] = $value;
        }

        return $counters;
    }
}
