<?php declare(strict_types=1);

namespace App\Domain;

use App\Domain\Exception\PartyDoesNotExist;
use App\Domain\Exception\UserDoesNotHostParty;

interface PartyStorage
{
    /** @return Party[] */
    public function listParties(): array;

    public function addParty(Party $party): self;

    /** @throws PartyDoesNotExist */
    public function getParty(GUID $partyId): Party;

    /** @throws PartyDoesNotExist|UserDoesNotHostParty */
    public function deleteParty(GUID $partyId): void;
}