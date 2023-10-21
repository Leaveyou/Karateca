# Karateca

## Installation

Running this application requires Docker.

In a nutshell, installation steps are:
* clone repository.
* install dependencies 
~~~ shell
docker compose up composer_update
~~~
* `docker compose up`

### Linux caveats

* Works with commands above. Depending on configuration might require `sudo`

### Windows caveats

Performance on Windows systems will be very slow unless the repository resides inside a WSL image.
* Install Ubuntu from the Microsoft store
* Write `\\wsl.localhost\` in the explorer address bar to access wsl filesystem.
* Navigate to the Ubuntu filesystem
* clone there
* Configure Docker to use WSL2
* Configure Docker to access the Ubuntu image

![wsl integration](docs/docker_settings_wsl_integration.png)

You probably want to use your current GIT installation rather than the one that comes with Ubuntu.
Make sure to configure your IDE to use your default git on windows, perhaps `C:\Program Files\Git\bin\`

Git might complain about repository ownership. To soothe its worries run this on the host machine, not the container:

~~~ shell
git config --global --add safe.directory '%(prefix)///wsl.localhost/Ubuntu-22.04/PATH_TO_REPOSITORY'
git config --global --add safe.directory '%(prefix)///wsl$/Ubuntu-22.04/PATH_TO_REPOSITORY'
~~~

Or

~~~ shell
git config --global --add safe.directory '*'
~~~

Or just configure git on the Ubuntu machine: keys, gpg, GitHub, etc...

External: [Docker desktop wsl2 best practices](https://www.docker.com/blog/docker-desktop-wsl-2-best-practices/)

## TODO:

* [x] Delete song
* [x] Reorder playlist by splicing to preserve indices
* [x] Make `YoutubeSong` not know the singer and make separate class for `PlaylistSong` which contains it.
* [ ] Meta: gpg key
* [ ] switch from redis to valkey-io/valkey
* [ ] fix functional tests ide configuration file
* [ ] fix git dubious ownership requiring trust repository
* [ ] Make GUIDs strings <br>
      **_OR_** use `ds/Map` extension to be able to array-access objects as keys<br>
      **_OR_** use `ds/Hashable`
* [ ] Investigate using `ds/Sequence` for storing PlaylistSongs. <br>
      Breaks access by ID since requires int keys. <br>
      Has native functions for inserting songs at specified index
* [ ] Run functional tests on separate redis container to prevent accidental interference.<br> Temporarily using separate redis db.
* [ ] `redis.karateca      | 10:C 09 Dec 2024 13:50:46.736 # WARNING Memory overcommit must be enabled! Without it, a background save or replication may fail under low memory condition. Being disabled, it can also cause failures without low memory condition, see https://github.com/jemalloc/jemalloc/issues/1328. To fix this issue add 'vm.overcommit_memory = 1' to /etc/sysctl.conf and then reboot or run the command 'sysctl vm.overcommit_memory=1' for this to take effect.`

~~~ mermaid
---
title: Class Diagram
---
classDiagram

    ApplicationUser --|> PartyStorage: uses
    ApplicationUser --|> Party: uses
    
    RuntimePartyStorage ..|> PartyStorage: implements
    RedisPartyStorage ..|> PartyStorage: implements
    
    ApplicationUser ..|> Host: implements
    Party "1" o-- "0..*" PartySong
    
    Party --|> Host: has
    
    PartyStorage "1" *-- "0..*" Party: contains
    
    namespace Infrastructure {
        class RuntimePartyStorage
        class RedisPartyStorage
    
        class ApplicationUser {
            throwParty(): Party
            deleteParty(): void
            listParties(): Party[]
            enqueueSong(Party, YoutubeSong)
            deleteSong(Party)
            listSongs(Party)
        }
    }
    
    namespace domain {
        class Host {
            <<interface>> 
        }
        class Party {
            host: Host
            id: 
            addSong(): PartySong
            deleteSong(): void
            moveSong(): void
        }
        class PartySong {
            id
            YoutubeSong
            singer
        }
        class PartyStorage {
            <<interface>> 
            playlists: Party[]
            addParty() : void
            deleteParty(): void
            getParty(): Party
            listParties(): Party[]
            storeParty() : void
        } 
    }
    
    note for PartyStorage "Does the storage\nvia storeParty()\nOR via each action"

~~~