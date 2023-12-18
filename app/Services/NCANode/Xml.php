<?php

namespace App\Services\NCANode;

use App\Services\NCANode\DTO\Certificate;
use App\Services\NCANode\DTO\Subject;
use App\Services\NCANode\DTO\Verify;

final class Xml
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function verify(string $xml): Verify
    {
        $response = $this->client->post('xml/verify/', [
            'revocationCheck' => ['OCSP'],
            'xml' => $xml
        ]);

        $signer = $response['signers'][0];

        return new Verify(
            $response['valid'],
            new Certificate(
                $signer['valid'],
                $signer['notBefore'],
                $signer['notAfter'],
                new Subject(
                    $signer['subject']['commonName'],
                    $signer['subject']['surName'],
                    $signer['subject']['iin'],
                    $signer['subject']['country'],
                    $signer['subject']['dn'],
                ),
                $signer['keyUsage'],
            )
        );
    }
}
