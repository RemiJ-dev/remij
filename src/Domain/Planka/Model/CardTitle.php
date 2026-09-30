<?php

declare(strict_types=1);

namespace App\Domain\Planka\Model;

/**
 * Titre d'une carte Planka, éventuellement préfixé par son numéro : « #42 · Titre ».
 */
final readonly class CardTitle
{
    private const string SEPARATOR = ' · ';
    private const string PATTERN = '/^#(\d+)\s*·\s*(.*)$/su';

    public function __construct(
        public ?int $number,
        public string $text,
    ) {
    }

    public static function fromName(string $name): self
    {
        $name = trim($name);

        if (1 === preg_match(self::PATTERN, $name, $matches)) {
            return new self((int) $matches[1], trim($matches[2]));
        }

        return new self(null, $name);
    }

    public function withNumber(int $number): self
    {
        return new self($number, $this->text);
    }

    public function __toString(): string
    {
        if (null === $this->number) {
            return $this->text;
        }

        return '#' . $this->number . self::SEPARATOR . $this->text;
    }
}
