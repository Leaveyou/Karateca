<?php declare(strict_types=1);

namespace App\Domain;

class PartySong
{
    public readonly GUID $id;
    public readonly YoutubeSong $song;
    public readonly ApplicationUser $singer;

    /**
     * @param GUID $id
     * @param YoutubeSong $song
     * @param ApplicationUser $singer
     */
    public function __construct(GUID $id, YoutubeSong $song, ApplicationUser $singer)
    {
        $this->song = $song;
        $this->singer = $singer;
        $this->id = $id;
    }
}