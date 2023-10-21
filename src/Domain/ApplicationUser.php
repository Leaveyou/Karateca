<?php declare(strict_types=1);

namespace App\Domain;

use App\Domain\Exception\UserDoesNotHostParty;
use App\Domain\Exception\UserDoesNotOwnSong;

/**
 * Class responsibility: Orchestrates with PartyStorage class in a way that is indicative of
 * the current user role restrictions
 */
class ApplicationUser implements Host
{
    private string $firstName;
    private string $lastName;
    private string $nickname;
    private PartyStorage $partyStorage;
    public GUID $id;

    public function __construct(PartyStorage $partyStorage, GUID $id)
    {
        $this->partyStorage = $partyStorage;
        $this->id = $id;
    }

    public function deleteParty(GUID $partyId): void
    {
        $party = $this->partyStorage->getParty($partyId);
        if ($party->host !== $this) {
            throw new UserDoesNotHostParty("Cannot delete party. It belongs to someone else.");
        }
        $this->partyStorage->deleteParty($partyId);
    }

    /** @return Party[] */
    public function listParties(): array
    {
        return $this->partyStorage->listParties();
    }

    public function throwParty(): Party
    {
        $party = new Party(GUID::generate(), $this);
        $this->partyStorage->addParty($party);
        return $party;
    }

    public function enqueueSong(GUID $partyId, YoutubeSong $song): PartySong
    {
        $party = $this->partyStorage->getParty($partyId);
        $playlistItem = new PartySong(GUID::generate(), $song, $this);
        $party->enqueueSong($playlistItem);
        return $playlistItem;
    }

    public function deleteSong(GUID $partyId, PartySong $song): void
    {
        $party = $this->partyStorage->getParty($partyId);
        if (!in_array($this, [$party->host, $song->singer], true)) {
            throw new UserDoesNotOwnSong("Cannot delete song. It belongs to someone else.");
        }
        $party->deleteSong($song);
    }

    public function moveSong(GUID $partyId, GUID $songId, ?GUID $moveBeforeId): void
    {
        $party = $this->partyStorage->getParty($partyId);
        if ($party->host !== $this) {
            throw new UserDoesNotHostParty("Cannot reorder songs. You do not host the party.");
        }
        $party->moveSong($songId, $moveBeforeId);
    }
}