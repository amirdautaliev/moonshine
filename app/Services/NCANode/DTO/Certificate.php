<?php

namespace App\Services\NCANode\DTO;

final class Certificate
{
    /**
     * @var boolean
     */
    public $valid;

    /**
     * date
     * @var string
     */
    public $notBefore;

    /**
     * date
     * @var string
     */
    public $notAfter;

    /**
     * @var string
     */
    public $keyUsage;

    /**
     * @var Subject
     */
    public $subject;

    public function __construct(
        bool   $valid,
        string $notBefore,
        string $notAfter,
               $subject,
        string $keyUsage
    )
    {
        $this->valid = $valid;
        $this->subject = $subject;
        $this->keyUsage = $keyUsage;
        $this->notBefore = $notBefore;
        $this->notAfter = $notAfter;
    }
}
