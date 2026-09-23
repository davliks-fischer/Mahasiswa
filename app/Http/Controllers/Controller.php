<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    // Ganti dengan link Ngrok lu yang lagi jalan sekarang
    protected string $ngrokBaseUrl = 'https://empirical-brigade-amusable.ngrok-free.dev';

    /**
     * Fungsi Helper untuk GET Data API dari Ngrok
     */
    protected function apiGet(string $endpoint): array
    {
        try {
            $response = Http::withHeaders([
                'ngrok-skip-browser-warning' => 'true', // Trik sakti dari kodingan PKL lu
                'Accept' => 'application/json'
            ])
            ->timeout(30)
            ->get($this->ngrokBaseUrl . $endpoint);

            if ($response->failed()) {
                return [];
            }

            $json = $response->json();
            return is_array($json) && isset($json['data']) ? $json['data'] : [];

        } catch (\Exception $e) {
            return [];
        }
    }

    /**
     * Fungsi Helper untuk POST Data API ke Ngrok
     */
    protected function apiPost(string $endpoint, array $data)
    {
        try {
            $response = Http::withHeaders([
                'ngrok-skip-browser-warning' => 'true',
                'Accept' => 'application/json'
            ])
            ->timeout(30)
            ->post($this->ngrokBaseUrl . $endpoint, $data);

            return $response->json();

        } catch (\Exception $e) {
            return ['status' => 'error', 'pesan' => $e->getMessage()];
        }
    }
}