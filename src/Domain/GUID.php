<?php declare(strict_types=1);

namespace App\Domain;

use Stringable;

readonly class GUID implements Stringable
{

    public function __construct(
        private string $stringRepresentation
    ){}

    public static function generate(): self
    {
        $randomString = self::randomUID();
        return new self($randomString);
    }

    private static function randomUID(): string
    {
        $bytes = 5;
        return bin2hex(random_bytes($bytes)) . "-"
            . bin2hex(random_bytes($bytes)) . "-"
            . bin2hex(random_bytes($bytes));
    }

    public function __toString(): string
    {
        return $this->stringRepresentation;
    }
}
