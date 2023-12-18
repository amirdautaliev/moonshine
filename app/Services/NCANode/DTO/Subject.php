<?php

namespace App\Services\NCANode\DTO;

final class Subject
{
    public $commonName;

    public $surName;

    public $iin;

    public $country;

    public $dn;

    public function __construct(
        string $commonName,
        string $surName,
        string $iin,
        string $country,
        string $dn
    )
    {
        $this->commonName = $commonName;
        $this->surName = $surName;
        $this->iin = $iin;
        $this->country = $country;
        $this->dn = $dn;
    }
}
