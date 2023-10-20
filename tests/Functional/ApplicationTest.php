<?php declare(strict_types=1);

namespace App\Tests\Functional;

use App\Domain\ApplicationUser;
use App\Domain\GUID;
use App\Domain\Party;
use App\Domain\RedisPartyStorage;
use App\Domain\YoutubeSong;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Redis;
use RedisException;

class ApplicationTest extends MockeryTestCase
{
    const REDIS_TEST_DB = 0;
    private RedisPartyStorage $partyStorage;
    private Redis $redis;

    /** @throws RedisException */
    public function setUp(): void
    {
        $this->redis = new Redis(["host" => "redis.karateca"]);
        $this->redis->select(self::REDIS_TEST_DB);
        $dbIsEmpty = count($this->redis->keys("*")) === 0;
        if (!$dbIsEmpty) die("\e[31m!!! Cannot run tests. Database is not empty. Functional tests use the database and clear it afterwords. Don't run them in production. \e[0m");
        $this->partyStorage = new RedisPartyStorage($this->redis);
    }

    /** @throws RedisException */
    public function tearDown(): void
    {
        $this->redis->flushDB();
    }

    function testUsersGetEmptyListWhenNoParties()
    {
        $parties = $this->partyStorage->listParties();
        $this->assertEquals([], $parties, "The user should have gotten an empty list since there are no parties defined.");
    }

    function testAddingParties()
    {
        $guid = GUID::generate();
        $gicu = new ApplicationUser($this->partyStorage, GUID::generate());
        $party = new Party($guid, $gicu);
        $this->partyStorage->addParty($party);

        $addedParty = $this->partyStorage->getParty($party->getId());
        $this->assertEquals($party, $addedParty, "Expected stored party to be in the database.");
    }

    public function testSongOperations()
    {
        $gicu = new ApplicationUser($this->partyStorage, GUID::generate());
        $party = $gicu->throwParty();

        $gicu->enqueueSong($partyId, $song);

    }
}
