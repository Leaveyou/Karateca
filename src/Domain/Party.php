<?php declare(strict_types=1);

namespace App\Domain;

class Party
{
    private ApplicationUser $host;

    public readonly GUID $id;

    public function __construct(GUID $id, ApplicationUser $host)
    {
        $this->host = $host;
        $this->id = $id;
    }

    public function getHost(): ApplicationUser
    {
        return $this->host;
    }

    public function getId(): GUID
    {
        return $this->id;
    }


}