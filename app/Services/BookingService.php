<?php

namespace App\Services;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class BookingService
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => config('services.booking_com.api_url'),
            'timeout' => 10.0,
        ]);

        $this->apiKey = config('services.booking_com.api_key');
    }

    public function checkAvailability($propertyId, $checkInDate, $checkOutDate, $adults = 1, $children = 0)
    {
        try {
            $response = $this->client->get('bookings.getAvailability', [
                'query' => [
                    'hotel_ids' => $propertyId,
                    'checkin' => $checkInDate,
                    'checkout' => $checkOutDate,
                    'room1' => "$adults,$children"
                ],
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode($this->apiKey . ':')
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            if (isset($data) && !empty($data)) {
                return $data;
            }

            return null;

        } catch (\Exception $e) {
            Log::error('Error checking availability: ' . $e->getMessage());
            throw new \Exception('Error checking availability');
        }
    }
}
