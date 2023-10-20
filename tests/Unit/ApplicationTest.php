<?php declare(strict_types=1);

namespace App\Tests\Unit;
use App\Domain\ApplicationUser;
use App\Domain\Exception\PartyDoesNotExist;
use App\Domain\Exception\SongDoesNotExist;
use App\Domain\Exception\UserDoesNotHostParty;
use App\Domain\Exception\UserDoesNotOwnSong;
use App\Domain\GUID;
use App\Domain\Party;
use App\Domain\RuntimePartyStorage;
use App\Domain\YoutubeSong;
use Mockery\Adapter\Phpunit\MockeryTestCase;

class ApplicationTest extends MockeryTestCase
{
    function testUsersGetEmptyListWhenNoParties()
    {
        $partyList = new RuntimePartyStorage();
        $george = new ApplicationUser($partyList, GUID::generate());

        $parties = $george->listParties();
        $this->assertEquals([], $parties, "The user should have gotten an empty list since there are no parties defined.");
    }

    function testUserCanCreateParty()
    {
        $partyCollection = new RuntimePartyStorage();
        $george = new ApplicationUser($partyCollection, GUID::generate());

        $additionResponse = $george->throwParty();

        $this->assertInstanceOf(Party::class, $additionResponse, "Expected function `addParty` to return newly added party.");

        $partyCollection = $partyCollection->listParties();
        $this->assertCount( 1, $partyCollection, "Expected one party in list after one add.");
        $this->assertArrayHasKey((string)$additionResponse->getId(), $partyCollection);

        $this->assertContains($additionResponse, $partyCollection, "Expected parties list to contain newly added party.");
        $host = $additionResponse->getHost();

        $this->assertEquals($george, $host, "Expected party host to be the guy who threw the party.");
    }

    function testOnlyHostCanDeleteParty()
    {
        $partyCollection = new RuntimePartyStorage();
        $george = new ApplicationUser($partyCollection, GUID::generate());
        $deanna = new ApplicationUser($partyCollection, GUID::generate());

        $partyOfGeorge = $george->throwParty();
        $partyOfDeanna = $deanna->throwParty();

        $partyList = $partyCollection->listParties();
        $this->assertCount( 2, $partyList, "Expected two parties in list after second add.");
        $this->assertContains($partyOfGeorge, $partyList, "Expected parties list to contain party of George.");
        $this->assertContains($partyOfDeanna, $partyList, "Expected parties list to contain party of Deanna.");

        $this->expectException(UserDoesNotHostParty::class);
        $deanna->deleteParty($partyOfGeorge->getId());

        $george->deleteParty($partyOfGeorge->getId());

        $this->expectException(PartyDoesNotExist::class);
        $partyCollection->getParty($partyOfGeorge->getId());

        $partyList = $partyCollection->listParties();
        $this->assertCount( 1, $partyList, "Expected one party in list after deletion of George's.");
        $this->assertContains($partyOfDeanna, $partyList, "Expected parties list to contain party of Deanna.");
    }

    function testUsersCanAddSongsToParty()
    {
        $partyCollection = new RuntimePartyStorage();
        $george = new ApplicationUser($partyCollection, GUID::generate());
        $deanna = new ApplicationUser($partyCollection, GUID::generate());
        $partyOfGeorge = $george->throwParty();
        $song = new YoutubeSong($deanna, "4DUGRWjdNLI", GUID::generate());
        $deanna->enqueueSong($partyOfGeorge->getId(), $song);
        $songs = $partyOfGeorge->listSongs();
        $this->assertContains($song, $songs);
    }

    function testUsersCanDeleteOwnSongsFromParty()
    {
        $partyCollection = new RuntimePartyStorage();
        $george = new ApplicationUser($partyCollection, GUID::generate());
        $deanna = new ApplicationUser($partyCollection, GUID::generate());
        $lucretia = new ApplicationUser($partyCollection, GUID::generate());
        $partyOfGeorge = $george->throwParty();

        $songOfDeanna = new YoutubeSong($deanna, "CCC", GUID::generate() );
        $deanna->enqueueSong($partyOfGeorge->getId(), $songOfDeanna);

        $songOfLucretia = new YoutubeSong($lucretia, "AAA", GUID::generate());
        $lucretia->enqueueSong($partyOfGeorge->getId(), $songOfDeanna);

        $this->assertContains($songOfDeanna, $partyOfGeorge->listSongs());

        $this->expectException(UserDoesNotOwnSong::class);
        $lucretia->deleteSong($partyOfGeorge->getId(), $songOfDeanna);
        $this->assertContains($songOfDeanna, $partyOfGeorge->listSongs(), "Expected Lucretia to fail deleting someone else's songs");

        $deanna->deleteSong($partyOfGeorge->getId(), $songOfDeanna);
        $this->assertNotContains($songOfDeanna, $partyOfGeorge->listSongs(), "Expected Deana to be able to delete own songs");

        $george->deleteSong($partyOfGeorge->getId(), $songOfLucretia);
        $this->assertNotContains($songOfDeanna, $partyOfGeorge->listSongs(), "Expected Party owner to be able to delete Lucretia's song even if he/she does not own the song itself.");
    }

    function testPartyOwnerCanReorderSongs()
    {
        $partyCollection = new RuntimePartyStorage();
        $george = new ApplicationUser($partyCollection, GUID::generate());
        $deanna = new ApplicationUser($partyCollection, GUID::generate());
        $lucretia = new ApplicationUser($partyCollection, GUID::generate());

        $partyOfGeorge = $george->throwParty();

        $songOfDeanna = new YoutubeSong($deanna, "AAA", GUID::generate() );
        $deanna->enqueueSong($partyOfGeorge->getId(), $songOfDeanna);

        $songOfLucretia = new YoutubeSong($lucretia, "BBB", GUID::generate());
        $lucretia->enqueueSong($partyOfGeorge->getId(), $songOfLucretia);

        $secondSongOfDeanna = new YoutubeSong($deanna, "CCC", GUID::generate() );
        $deanna->enqueueSong($partyOfGeorge->getId(), $secondSongOfDeanna);

        $george->moveSong($partyOfGeorge->getId(), $secondSongOfDeanna->guid, $songOfLucretia->guid);

        $this->assertEquals($songOfDeanna      , $partyOfGeorge->getSongByIndex(0));
        $this->assertEquals($secondSongOfDeanna, $partyOfGeorge->getSongByIndex(1));
        $this->assertEquals($songOfLucretia    , $partyOfGeorge->getSongByIndex(2));

        $george->moveSong($partyOfGeorge->getId(), $songOfDeanna->guid, null);

        $this->assertEquals($secondSongOfDeanna, $partyOfGeorge->getSongByIndex(0));
        $this->assertEquals($songOfLucretia    , $partyOfGeorge->getSongByIndex(1));
        $this->assertEquals($songOfDeanna      , $partyOfGeorge->getSongByIndex(2));

        try {
            $george->moveSong($partyOfGeorge->getId(), GUID::generate(), $songOfLucretia->guid);
            $this->fail("Should not be able to move song Ids not in the playlist");
        } catch (SongDoesNotExist){}

        try {
            $george->moveSong($partyOfGeorge->getId(), $songOfLucretia->guid, GUID::generate());
            $this->fail("Should not be able to move song before a song that does not exist");
        } catch (SongDoesNotExist) {}

        $this->assertEquals($secondSongOfDeanna->guid, $partyOfGeorge->getSongByIndex(0)->guid);
        $this->assertEquals($songOfLucretia->guid    , $partyOfGeorge->getSongByIndex(1)->guid);
        $this->assertEquals($songOfDeanna->guid      , $partyOfGeorge->getSongByIndex(2)->guid);
    }

    function testNoOtherThanHostCanReorderSongs()
    {
        $partyCollection = new RuntimePartyStorage();
        $george = new ApplicationUser($partyCollection, GUID::generate());
        $deanna = new ApplicationUser($partyCollection, GUID::generate());
        $lucretia = new ApplicationUser($partyCollection, GUID::generate());

        $partyOfGeorge = $george->throwParty();

        $songOfDeanna = new YoutubeSong($deanna, "AAA", GUID::generate() );
        $deanna->enqueueSong($partyOfGeorge->getId(), $songOfDeanna);

        $songOfLucretia = new YoutubeSong($lucretia, "BBB", GUID::generate());
        $lucretia->enqueueSong($partyOfGeorge->getId(), $songOfLucretia);

        $secondSongOfDeanna = new YoutubeSong($deanna, "CCC", GUID::generate() );
        $deanna->enqueueSong($partyOfGeorge->getId(), $secondSongOfDeanna);

        $this->expectException(UserDoesNotHostParty::class);
        $deanna->moveSong($partyOfGeorge->getId(), GUID::generate(), $songOfLucretia->guid);

    }
}
