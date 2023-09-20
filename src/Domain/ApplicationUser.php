<?php declare(strict_types=1);

namespace App\Domain;

use App\Domain\Exception\UserDoesNotHostParty;

/**
 * Class responsibility: Orchestrates with PartyStorage class in a way that is indicative of
 * the current user role restrictions
 */
class ApplicationUser
{
    private string $firstName;
    private string $lastName;
    private string $nickname;
    private PartyStorage $partyStorage;

    public function __construct(PartyStorage $partyStorage)
    {
        $this->partyStorage = $partyStorage;
    }

    public function deleteParty(GUID $partyId): void
    {
        $party = $this->partyStorage->getParty($partyId);
        if ($party->getHost() !== $this) {
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
}