<?php

namespace App\Services\NCANode\DTO;

final class Verify
{
    public $valid;
    public $certificate;

    public function __construct(bool $valid, Certificate $certificate)
    {
        $this->valid = $valid;
        $this->certificate = $certificate;
    }
}
