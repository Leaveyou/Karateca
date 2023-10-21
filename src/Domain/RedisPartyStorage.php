<?php declare(strict_types=1);

namespace App\Domain;

use App\Domain\PartyStorage;
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
            $this->redis->hGetAll($this->partySettingsIndexKey($partyId));
        }
        $response = $this->redis->exec();

        $return = [];
        foreach ($response as $partyData) {
            $host = new ApplicationUser($this, new GUID($partyData['host']));
            $return[$partyData['id']] = new Party(new GUID($partyData['id']), $host);
        }
        return $return;
    }

    public function addParty(Party $party): PartyStorage
    {
        $partyId = (string)$party->id;

        $this->redis->multi(Redis::PIPELINE);
        {
            $this->redis->zAdd("PARTIES", time(), $partyId);
            $this->redis->hMSet($this->partySettingsIndexKey($partyId), [
                "id" => $partyId,
                "host" => (string)$party->host->id,
            ]);
        }
        $this->redis->exec();

        return $this;
    }

    public function getParty(GUID $partyId): Party
    {
        $keyId = $this->partySettingsIndexKey((string)$partyId);
        $partyData = $this->redis->hMGet($keyId, ["id", "host"]);
        return new Party(new GUID($partyData['id']), new ApplicationUser($this, new GUID($partyData['host'])));
    }

    public function deleteParty(GUID $partyId): void
    {
        // TODO: Implement deleteParty() method.
    }

    private function partySettingsIndexKey(string $partyId): string
    {
        return "PARTY-SETTINGS_" . $partyId;
    }

}