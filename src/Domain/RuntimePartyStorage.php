<?php declare(strict_types=1);

namespace App\Domain;

use App\Domain\Exception\PartyDoesNotExist;

class RuntimePartyStorage implements PartyStorage
{
    /** @var Party[] */
    private array $parties = [];

    /** @return Party[] */
    public function listParties(): array
    {
        return $this->parties;
    }

    public function addParty(Party $party): self
    {
        $this->parties[(string)$party->id] = $party;
        return $this;
    }

    public function getParty(GUID $partyId): Party
    {
        $this->ensurePartyExists($partyId);
        return $this->parties[(string)$partyId];
    }

    public function deleteParty(GUID $partyId): void
    {
        $this->ensurePartyExists($partyId);
        unset($this->parties[(string)$partyId]);
    }

    private function ensurePartyExists(GUID $partyId): void
    {
        if (!isset($this->parties[(string)$partyId]))
            throw new PartyDoesNotExist("The requested party does not exist.");
    }
}
