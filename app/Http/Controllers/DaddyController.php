<?php

namespace App\Http\Controllers;

use App\TiltifyClient;
use Illuminate\Http\Request;

class DaddyController extends Controller
{
    const RELAY_CAMPAIGN_ID = 37917;

    public function __construct(private TiltifyClient $client) {}
     public function home()
     {
         return view('home', [
             'title' => 'Donation Daddy',
             'subtitle' => 'Be a Donation Daddy Today!',
             'assetpath' => 'donationdaddy'
         ]);
     }

     public function coin()
     {
         $campaigns = $this->getSortedCampaigns();

         $countSingle = 0;
         $countSet = 0;
         $singles = [];
         $sets = [];
         foreach ($campaigns as $campaign)
         {
            if ($campaign->raised >= 1) $countSingle++;
            if ($campaign->raised >= 100) $countSet++;
            if ($campaign->raised < 1) {
                $singles[] = $campaign;
            } elseif ($campaign->raised < 100) {
                $sets[] = $campaign;
            }
         }

         return view('coin', [
            'title' => 'Coin Me, Daddy',
            'subtitle' => 'Help someone out who needs just one dollar to get a Relay for St Jude challenge coin',
            'assetpath' => 'coinme',
            'countSingle' => $countSingle,
            'countSet' => $countSet,
            'singles' => $singles,
            'sets' => $sets,
            'image' => 'coins2025.png',
         ]);
     }

     public function deskmat()
     {
         $campaigns = $this->getSortedCampaigns();

         $count = 0;
         $need = [];

         foreach ($campaigns as $campaign) {
             if ($campaign->raised >= 250) {
                 $count++;
             } else {
                 $need[] = $campaign;
             }
         }

         return view('singleitem', [
             'title' => 'Desk Mat Help',
             'subtitle' => 'Help someone out who is close to getting a Relay for St Jude desk mat',
             'assetpath' => 'deskmat',
             'count' => $count,
             'need' => $need,
             'limit' => 250,
             'item' => 'desk mat',
             'image' => 'deskmat.png',
         ]);
     }

    public function bag()
    {
        $campaigns = $this->getSortedCampaigns();

        $count = 0;
        $need = [];

        foreach ($campaigns as $campaign) {
            if ($campaign->raised >= 500) {
                $count++;
            } else {
                $need[] = $campaign;
            }
        }

        return view('singleitem', [
            'title' => 'Backpack Help',
            'subtitle' => 'Help someone out who is close to getting a Relay for St Jude backpack',
            'assetpath' => '500',
            'count' => $count,
            'need' => $need,
            'limit' => 500,
            'item' => 'backpack',
            'image' => 'bag.png',
        ]);
    }

    public function septembed()
    {
        return view('septembed', [
            'title' => 'Septembed',
            'subtitle' => 'Embed your Relay for St Jude campaign on your website',
            'assetpath' => 'septembed',
        ]);
    }

     public function treats()
     {
         return view('treats');
     }

    private function getSortedCampaigns()
    {
        return collect($this->client->getCampaigns())
            ->sort(function ($a, $b) {
                return (int) $a->goal < (int) $b->goal;
            })
            ->filter(function ($campaign) {
                return $campaign->id !== self::RELAY_CAMPAIGN_ID;
            });
    }
}
