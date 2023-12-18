<?php

namespace App\Services\NCANode;

use App\Services\NCANode\DTO\Certificate;
use App\Services\NCANode\DTO\Subject;
use Illuminate\Support\Facades\Http;

final class Client
{
    private $domain;

    public function __construct()
    {
        $this->domain = config('services.ncanode.host') . ':' . config('services.ncanode.port');
    }

    public function post(string $path, array $data = []): array
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json'
        ])->post($this->domain . '/' . $path, $data)->json();

        if ($response['status'] !== 200) {
            abort(500, 'error: ' . $response['message']);
        }

        return $response;
    }
}
