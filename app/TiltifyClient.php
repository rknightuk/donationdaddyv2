<?php

namespace App;

use App\Models\DonationTreat;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class TiltifyClient {

    const RELAY_TEAM_ID = '1c6d5c76-1804-48fa-a474-2bfe1c52f48c';
    const RELAY_CAMPAIGN_ID = '37917f91-8a86-4c28-b11a-0e25390c02d0';

    const FILTERED_REWARDS = [
        'No More Chemo Party',
        'New Toy for Hospital Play Areas',
        'One day of meals for a patient',
        'Art Supplies',
        'Groceries for Family',
        'One day of chemotherapy for a St. Jude patient',
        'Two Days of Oxygen',
        'Airfare for St. Jude patients and families',
    ];

    const KEEP_FOR_RELAY = [
        'Relay Wallpapers + macOS Screensaver',
        'Sticker Pack + Digital Bundle',
    ];

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

        $data = Arr::get($res, 'data', []);

        if ($cursor = Arr::get($res, 'metadata.after')) {
            $slug = 'https://v5api.tiltify.com/api/public/fundraising_events/' . self::RELAY_TEAM_ID . '/supporting_events?limit=100&after=' . $cursor;

            $res2 = Http::withToken(
                $token,
            )->get($slug)->json();

            $data = array_merge($data, Arr::get($res2, 'data', []));
        }

        return array_map(
            fn($item) => Campaign::fromApi($item),
            $data,
        );
    }

    public function getRewards()
    {
        $token = $this->getToken();

        $campaigns = $this->getCampaigns();

        foreach ($campaigns as $campaign)
        {
            $id = $campaign->campaign_id;
            $count = DonationTreat::where('campaign_id', $id)->count();

            if ($count > 0) {
                $latest = DonationTreat::where('campaign_id', $id)->orderBy('updated_at', 'asc')->first();

                if ($latest->updated_at->diffInHours(Carbon::now()) > 12) {
                    continue;
                }
            }

            $slug = \sprintf('https://v5api.tiltify.com/api/public/campaigns/%s/rewards', $id);

            $res = Http::withToken(
                $token,
            )->get($slug)->json();

            $ids = collect($res['data'] ?? [])->filter(function ($reward) use ($id) {
                $filterableRewards = self::FILTERED_REWARDS;
                if ($id !== self::RELAY_CAMPAIGN_ID) {
                    $filterableRewards = array_merge($filterableRewards, self::KEEP_FOR_RELAY);
                }
                return !in_array($reward['name'], $filterableRewards);
            })->map(function ($reward) use ($id, $campaign) {
                $treat = DonationTreat::firstOrCreate([
                    'campaign_id' => $id,
                    'reward_id' => $reward['id'],
                ], [
                    'campaign_name' => $campaign->name,
                    'campaign_url' => $campaign->url,
                    'campaign_username' => $campaign->username,
                    'name' => $reward['name'],
                    'description' => $reward['description'] ?? '',
                    'cost' => Arr::get($reward, 'cost.value', 0),
                    'image' => Arr::get($reward, 'image.src', ''),
                ]);

                return $treat->id;
            })->toArray();

            DonationTreat::where('campaign_id', $campaign->campaign_id)->whereNotIn('id', $ids)->delete();
        }

        return DonationTreat::all();
    }

}
