<?php declare(strict_types=1);

namespace App\Domain;

use App\Domain\Party;

class YoutubeSong
{
    public readonly string $youtubeId;

    public readonly GUID|string $id;

    public function __construct(GUID $id, string $youtubeId)
    {
        $this->youtubeId = $youtubeId;
        $this->id = $id;
    }
}