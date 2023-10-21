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
        $this->assertArrayHasKey((string)$additionResponse->id, $partyCollection);

        $this->assertContains($additionResponse, $partyCollection, "Expected parties list to contain newly added party.");
        $host = $additionResponse->host;

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
        $deanna->deleteParty($partyOfGeorge->id);

        $george->deleteParty($partyOfGeorge->id);

        $this->expectException(PartyDoesNotExist::class);
        $partyCollection->getParty($partyOfGeorge->id);

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

        $song = new YoutubeSong(GUID::generate(), "4DUGRWjdNLI");

        $partySong = $deanna->enqueueSong($partyOfGeorge->id, $song);
        $this->assertEquals($song, $partySong->song);
    }

    function testUsersCanDeleteOwnSongsFromParty()
    {
        $partyCollection = new RuntimePartyStorage();
        $george = new ApplicationUser($partyCollection, GUID::generate());
        $deanna = new ApplicationUser($partyCollection, GUID::generate());
        $lucretia = new ApplicationUser($partyCollection, GUID::generate());
        $partyOfGeorge = $george->throwParty();

        $songOfDeanna = new YoutubeSong(GUID::generate(), "CCC");
        $playlistEntryOfDeanna = $deanna->enqueueSong($partyOfGeorge->id, $songOfDeanna);

        $songOfLucretia = new YoutubeSong(GUID::generate(), "AAA");
        $playlistEntryOfLucretia = $lucretia->enqueueSong($partyOfGeorge->id, $songOfLucretia);

        $this->expectException(UserDoesNotOwnSong::class);
        $lucretia->deleteSong($partyOfGeorge->id, $playlistEntryOfDeanna);
        $this->assertContains($playlistEntryOfDeanna, $partyOfGeorge->listSongs(), "Expected Lucretia to fail deleting someone else's songs");

        $deanna->deleteSong($partyOfGeorge->id, $playlistEntryOfDeanna);
        $this->assertNotContains($playlistEntryOfDeanna, $partyOfGeorge->listSongs(), "Expected Deana to be able to delete own songs");

        $george->deleteSong($partyOfGeorge->id, $playlistEntryOfLucretia);
        $this->assertNotContains($playlistEntryOfDeanna, $partyOfGeorge->listSongs(), "Expected Party owner to be able to delete Lucretia's song even if he/she does not own the song itself.");
    }

    function testPartyOwnerCanReorderSongs()
    {
        $partyCollection = new RuntimePartyStorage();
        $george = new ApplicationUser($partyCollection, GUID::generate());
        $deanna = new ApplicationUser($partyCollection, GUID::generate());
        $lucretia = new ApplicationUser($partyCollection, GUID::generate());

        $partyOfGeorge = $george->throwParty();

        $songOfDeanna = new YoutubeSong(GUID::generate() , "AAA");
        $playlistItemOfDeanna = $deanna->enqueueSong($partyOfGeorge->id, $songOfDeanna);

        $songOfLucretia = new YoutubeSong(GUID::generate(), "BBB");
        $playlistItemOfLucretia = $lucretia->enqueueSong($partyOfGeorge->id, $songOfLucretia);

        $secondSongOfDeanna = new YoutubeSong(GUID::generate() , "CCC");
        $secondPlaylistItemOfDeanna = $deanna->enqueueSong($partyOfGeorge->id, $secondSongOfDeanna);

        $george->moveSong($partyOfGeorge->id, $secondPlaylistItemOfDeanna->id, $playlistItemOfLucretia->id);

        $this->assertEquals($playlistItemOfDeanna      , $partyOfGeorge->getSongByIndex(0));
        $this->assertEquals($secondPlaylistItemOfDeanna, $partyOfGeorge->getSongByIndex(1));
        $this->assertEquals($playlistItemOfLucretia    , $partyOfGeorge->getSongByIndex(2));

        $george->moveSong($partyOfGeorge->id, $playlistItemOfDeanna->id, null);

        $this->assertEquals($secondPlaylistItemOfDeanna, $partyOfGeorge->getSongByIndex(0));
        $this->assertEquals($playlistItemOfLucretia    , $partyOfGeorge->getSongByIndex(1));
        $this->assertEquals($playlistItemOfDeanna      , $partyOfGeorge->getSongByIndex(2));

        try {
            $george->moveSong($partyOfGeorge->id, GUID::generate(), $playlistItemOfLucretia->id);
            $this->fail("Should not be able to move song Ids not in the playlist");
        } catch (SongDoesNotExist){}

        try {
            $george->moveSong($partyOfGeorge->id, $playlistItemOfLucretia->id, GUID::generate());
            $this->fail("Should not be able to move song before a song that does not exist");
        } catch (SongDoesNotExist) {}

        $this->assertEquals($secondPlaylistItemOfDeanna->id, $partyOfGeorge->getSongByIndex(0)->id);
        $this->assertEquals($playlistItemOfLucretia->id    , $partyOfGeorge->getSongByIndex(1)->id);
        $this->assertEquals($playlistItemOfDeanna->id      , $partyOfGeorge->getSongByIndex(2)->id);
    }

    public function testMovingLastItemToSamePosition()
    {
        $partyCollection = new RuntimePartyStorage();
        $george = new ApplicationUser($partyCollection, GUID::generate());
        $deanna = new ApplicationUser($partyCollection, GUID::generate());
        $lucretia = new ApplicationUser($partyCollection, GUID::generate());

        $partyOfGeorge = $george->throwParty();

        $songOfDeanna = new YoutubeSong(GUID::generate() , "AAA");
        $playlistItemOfDeanna = $deanna->enqueueSong($partyOfGeorge->id, $songOfDeanna);

        $songOfLucretia = new YoutubeSong(GUID::generate(), "BBB");
        $playlistItemOfLucretia = $lucretia->enqueueSong($partyOfGeorge->id, $songOfLucretia);

        $george->moveSong($partyOfGeorge->id, $playlistItemOfLucretia->id, null);

        $this->assertEquals($playlistItemOfDeanna  , $partyOfGeorge->getSongByIndex(0));
        $this->assertEquals($playlistItemOfLucretia, $partyOfGeorge->getSongByIndex(1));

    }

    function testNoOtherThanHostCanReorderSongs()
    {
        $partyCollection = new RuntimePartyStorage();
        $george = new ApplicationUser($partyCollection, GUID::generate());
        $deanna = new ApplicationUser($partyCollection, GUID::generate());
        $lucretia = new ApplicationUser($partyCollection, GUID::generate());

        $partyOfGeorge = $george->throwParty();

        $songOfDeanna = new YoutubeSong(GUID::generate() , "AAA");
        $deanna->enqueueSong($partyOfGeorge->id, $songOfDeanna);

        $songOfLucretia = new YoutubeSong(GUID::generate(), "BBB");
        $lucretia->enqueueSong($partyOfGeorge->id, $songOfLucretia);

        $secondSongOfDeanna = new YoutubeSong(GUID::generate() , "CCC");
        $deanna->enqueueSong($partyOfGeorge->id, $secondSongOfDeanna);

        $this->expectException(UserDoesNotHostParty::class);
        $deanna->moveSong($partyOfGeorge->id, GUID::generate(), $songOfLucretia->id);

    }
}
