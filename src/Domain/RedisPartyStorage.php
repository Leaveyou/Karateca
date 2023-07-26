<?php declare(strict_types=1);

namespace App\Domain;

use Redis;

class RedisPartyStorage implements PartyStorage
{
    private Redis $redis;

    public function __construct(Redis $redis)
    {
        $this->redis = $redis;
    }

    public function listParties(): array
    {
        $parties = $this->redis->zRange("PARTIES", 0, -1);
        
        $this->redis->multi(Redis::PIPELINE);
        foreach ($parties as $partyId){
            $this->redis->hGetAll($this->generatePartySettingsKey($partyId));
        }
        $response = $this->redis->exec();

        $return = [];
        foreach ($response as $partyData) {
            $host = new ApplicationUser($this);
            $return[$partyData['id']] = new Party(new GUID($partyData['id']), $host);
        }
        return $return;
    }

    public function addParty(Party $party): PartyStorage
    {
        $partyId = (string)$party->getId();

        $this->redis->multi(Redis::PIPELINE);
        {
            $this->redis->zAdd("PARTIES", time(), $partyId);
            $this->redis->hMSet($this->generatePartySettingsKey($partyId), [
                "id" => $partyId,
                "host" => $party->getHost(),
            ]);
        }
        $this->redis->exec();

        return $this;
    }

    public function getParty(GUID $partyId): Party
    {
        // TODO: Implement getParty() method.
    }

    public function deleteParty(GUID $partyId): void
    {
        // TODO: Implement deleteParty() method.
    }

    private function generatePartySettingsKey(string $partyId): string
    {
        return "PARTY-SETTINGS_" . $partyId;
    }
}