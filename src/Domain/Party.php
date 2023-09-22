<?php declare(strict_types=1);

namespace App\Domain;

class Party
{
    private ApplicationUser $host;

    public readonly GUID $id;

    /** @var YoutubeSong[] */
    private array $songs;

    public function __construct(GUID $id, ApplicationUser $host)
    {
        $this->host = $host;
        $this->id = $id;
    }

    public function getHost(): ApplicationUser
    {
        return $this->host;
    }

    public function getId(): GUID
    {
        return $this->id;
    }

    public function enqueueSong(YoutubeSong $song): void
    {
        $this->songs[] = $song;
    }

    /** @return YoutubeSong[] */
    public function listSongs(): array
    {
        return $this->songs;
    }

    public function deleteSong(YoutubeSong $song)
    {
        $songId = array_search($song, $this->songs);
        if ($songId === false) throw new Exception\SongDoesNotExist();
        unset($this->songs[$songId]);
    }
}