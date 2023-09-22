<?php declare(strict_types=1);

namespace App\Domain;

class YoutubeSong
{
    private ApplicationUser $singer;
    private string $youtubeId;

    /**
     * @param ApplicationUser $singer
     * @param string $youtubeId
     */
    public function __construct(ApplicationUser $singer, string $youtubeId)
    {
        $this->singer = $singer;
        $this->youtubeId = $youtubeId;
    }

    public function getSinger(): ApplicationUser
    {
        return $this->singer;
    }
}