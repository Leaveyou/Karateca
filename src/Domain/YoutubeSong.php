<?php declare(strict_types=1);

namespace App\Domain;

use App\Domain\Party;

class YoutubeSong
{
    private ApplicationUser $singer;
    public readonly string $youtubeId;

    public readonly GUID|string $guid;

    public function __construct(ApplicationUser $singer, string $youtubeId, GUID $guid)
    {
        $this->singer = $singer;
        $this->youtubeId = $youtubeId;
        $this->guid = $guid;
    }

    public function getSinger(): ApplicationUser
    {
        return $this->singer;
    }

}