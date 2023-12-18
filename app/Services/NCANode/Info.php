<?php

namespace App\Services\NCANode;

use App\Services\NCANode\DTO\Certificate;
use App\Services\NCANode\DTO\Subject;

final class Info
{
    private $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function x509(string $x509): Certificate
    {
        $response = $this->client->post('x509/info', [
            'revocationCheck' => ['OCSP'],
            'certs' => [$x509]
        ]);

        $signer = $response['signers'][0];

        return new Certificate(
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
        );
    }
}
