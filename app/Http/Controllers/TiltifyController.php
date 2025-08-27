<?php

namespace App\Http\Controllers;

use App\Campaign;
use App\TiltifyClient;
use Throwable;

class TiltifyController extends Controller
{

    public function __construct(public TiltifyClient $client)
    {

    }

    public function clearCache()
    {
        if (\request()->input('key') !== env('CACHE_CLEAR_KEY')) {
            return response()->json(['message' => 'Bye!']);
        }

        cache()->clear();

        return response()->json(['message' => 'Cache cleared successfully.']);
    }

    public function campaigns()
    {
        $key = 'tiltify_campaigns';

        if (cache()->has($key)) {
            return cache()->get($key);
        }

        $campaigns = $this->client->getCampaigns();

        cache()->put($key, $campaigns, now()->addMinutes(5));

        return $campaigns;
    }

    public function relay()
    {
        $key = 'tiltify_campaign_relay';

        if (cache()->has($key)) {
            return cache()->get($key);
        }

        $campaign = $this->client->getRelayCampaign();

        cache()->put($key, $campaign, now()->addMinutes(5));

        return $campaign;
    }

    public function campaign(): Campaign
    {
        // lol whoops
        $vanity = \request()->input('slug');
        $slug = \request()->input('vanity');

        if (!$slug || !$vanity) {
            return $this->relay();
        }

        $slug = \str_replace('@', '', $slug);

        $key = 'tiltify_campaign_' . $slug . '_' . $vanity;

        if (cache()->has($key)) {
            return cache()->get($key);
        }

        try {
            $campaign = $this->client->getCampaign($slug, $vanity);
        } catch (Throwable $e) {
            return $this->relay();
        }

        cache()->put($key, $campaign, now()->addMinutes(5));

        return $campaign;
    }

    public function fetchRewards()
    {
        if (\request()->input('key') !== env('CACHE_CLEAR_KEY')) {
            return response()->json(['message' => 'Bye!']);
        }

        $this->client->getRewards();

        return response()->json(['message' => 'Rewards fetched.']);
    }

    public function embed()
    {
        header('Access-Control-Allow-Origin: *');

        $campaign = $this->campaign();

        $currency = '$';

        return [
            'title' => $campaign->name,
            'url' => $campaign->url,
            'goal' => $currency . $campaign->goal,
            'raised' => $currency . $campaign->raised,
            'percentage' => $campaign->percentage,
        ];
    }
}
