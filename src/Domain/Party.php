<?php declare(strict_types=1);

namespace App\Domain;

use App\Domain\Exception\SongDoesNotExist;

class Party
{
    public readonly Host $host;

    public readonly GUID $id;

    /** @var PartySong[] */
    private array $songs;

    public function __construct(GUID $id, Host $host)
    {
        $this->host = $host;
        $this->id = $id;
    }


    public function enqueueSong(PartySong $song): void
    {
        $this->songs[(string)$song->id] = $song;
    }

    /** @return PartySong[] */
    public function listSongs(): array
    {
        return $this->songs;
    }

    public function deleteSong(PartySong $song): void
    {
        $songId = in_array($song, $this->songs);
        if ($songId === false) throw new Exception\SongDoesNotExist();
        unset($this->songs[(string)$song->id]);
    }

    public function getSongByIndex(int $offset): PartySong
    {
        return current(array_slice($this->songs, $offset, 1));
    }

    public function moveSong(GUID $songId, ?GUID $successor): void
    {
        if ($successor && !isset($this->songs[(string)$successor])) {
            throw new SongDoesNotExist("Cannot move song before specified song GUID. Could not find that GUID");
        }

        $song = $this->extractSong($songId);
        $position = $this->getPositionByKey($successor);

        $this->insertSong($song, $position);
    }

    public function extractSong(GUID $songId): PartySong
    {
        if (!isset($this->songs[(string)$songId])) {
            throw new SongDoesNotExist("Cannot find song with the provided GUID.");
        }

        $song = $this->songs[(string)$songId];
        unset($this->songs[(string)$songId]);
        return $song;
    }

    private function insertSong(PartySong $song, int|false $position): void
    {
        if ($position === false) {
            $position = count($this->songs);
        }
        $firstPart = array_slice($this->songs, 0, $position, true);
        $secondPart = array_slice($this->songs, $position, null, true);
        $this->songs = array_merge($firstPart, [(string)$song->id => $song], $secondPart);
    }

    public function getPositionByKey(?GUID $moveBeforeId): string|int|false
    {
        return array_search((string)$moveBeforeId, array_keys($this->songs), true);
    }

    public function getSong(GUID $songId): PartySong
    {
        if (!isset($this->songs[(string)$songId])) throw new SongDoesNotExist("Song does not exist");
        return $this->songs[(string)$songId];
    }
}