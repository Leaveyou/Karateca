<?php declare(strict_types=1);

namespace App\Domain;

interface Host
{
    public function getId(): GUID;
}