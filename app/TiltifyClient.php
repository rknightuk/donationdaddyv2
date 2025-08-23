<?php

namespace App;

use Illuminate\Support\Facades\Http;

class TiltifyClient {

    const RELAY_TEAM_ID = '1c6d5c76-1804-48fa-a474-2bfe1c52f48c';

    public function getToken()
    {
        $key = 'tiltify_token';

        if (cache()->has($key)) {
            return cache()->get($key);
        }

        $res = Http::asJson()->post('https://v5api.tiltify.com/oauth/token', [
            'grant_type' => 'client_credentials',
            'scope' => 'public',
            'client_id' => env('TILTIFY_CLIENT_ID'),
            'client_secret' => env('TILTIFY_CLIENT_SECRET'),
        ])->json();

        $token = $res['access_token'];

        cache()->put($key, $token, now()->addHour());

        return $token;
    }

    public function getCampaign(string $user, string $campaign)
    {
        $token = $this->getToken();

        $slug = \sprintf('https://v5api.tiltify.com/api/public/campaigns/by/slugs/%s/%s', $user, $campaign);

        $res = Http::withToken(
            $token,
        )->get($slug)->json();

        return Campaign::fromApi($res['data']);
    }

    public function getRelayCampaign()
    {
        $token = $this->getToken();

        $slug = 'https://v5api.tiltify.com/api/public/fundraising_events/' . self::RELAY_TEAM_ID;

        $res = Http::withToken(
            $token,
        )->get($slug)->json();

        return Campaign::fromApi($res['data']);
    }

    public function getCampaigns()
    {
        $token = $this->getToken();

        $slug = 'https://v5api.tiltify.com/api/public/fundraising_events/' . self::RELAY_TEAM_ID . '/supporting_events?limit=100';

        $res = Http::withToken(
            $token,
        )->get($slug)->json();

        return array_map(
            fn($item) => Campaign::fromApi($item),
            $res['data'] ?? [],
        );
    }

}
