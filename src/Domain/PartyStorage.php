<?php declare(strict_types=1);

namespace App\Domain;

use App\Domain\Exception\PartyDoesNotExit;
use App\Domain\Exception\UserDoesNotHostParty;

interface PartyStorage
{
    /** @return Party[] */
    public function listParties(): array;

    public function addParty(Party $party): self;

    /** @throws PartyDoesNotExit */
    public function getParty(GUID $partyId): Party;

    /** @throws PartyDoesNotExit|UserDoesNotHostParty */
    public function deleteParty(GUID $partyId): void;
}