<?php declare(strict_types=1);

namespace App\Domain;

use Stringable;

class GUID implements Stringable
{
    private readonly string $stringRepresentation;

    public function __construct(string $stringRepresentation)
    {
        $this->stringRepresentation = $stringRepresentation;
    }

    public static function generate(): self
    {
        $randomString =
            bin2hex(random_bytes(3)) . "-"
            . bin2hex(random_bytes(3)) . "-"
            . bin2hex(random_bytes(3));
        return new self($randomString);
    }

    public function __toString(): string
    {
        return $this->stringRepresentation;
    }
}