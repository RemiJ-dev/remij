<?php

declare(strict_types=1);

namespace App\Domain\Planka\Model;

use Symfony\Component\String\Slugger\AsciiSlugger;

/**
 * Nom de branche Git dérivé d'une carte : « <préfixe>/<numéro>-<slug-du-titre> ».
 */
final readonly class BranchName
{
    public const int SLUG_MAX_LENGTH = 50;
    private const string PATTERN = '/^([a-z]+)\/(\d+)(?:-([a-z0-9-]*))?$/';

    public function __construct(
        public string $prefix,
        public int $number,
        public string $slug,
    ) {
    }

    public static function fromTitle(string $prefix, int $number, string $title): self
    {
        $slug = new AsciiSlugger('fr')->slug($title)->lower()->toString();

        // Coupe au dernier tiret avant la limite, pour ne pas tronquer un mot.
        if (\strlen($slug) > self::SLUG_MAX_LENGTH) {
            $head = substr($slug, 0, self::SLUG_MAX_LENGTH + 1);
            $lastDash = strrpos($head, '-');
            $slug = rtrim(substr($head, 0, false === $lastDash || 0 === $lastDash ? self::SLUG_MAX_LENGTH : $lastDash), '-');
        }

        return new self($prefix, $number, $slug);
    }

    public static function parse(string $value): ?self
    {
        if (1 !== preg_match(self::PATTERN, trim($value), $matches)) {
            return null;
        }

        return new self($matches[1], (int) $matches[2], $matches[3] ?? '');
    }

    public function withPrefix(string $prefix): self
    {
        return new self($prefix, $this->number, $this->slug);
    }

    public function __toString(): string
    {
        return $this->prefix . '/' . $this->number . ('' !== $this->slug ? '-' . $this->slug : '');
    }
}
