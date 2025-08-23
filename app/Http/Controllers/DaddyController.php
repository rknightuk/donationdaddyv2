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
         ]);
     }

     public function deskmat()
     {
         return view('deskmat');
     }

     public function treats()
     {
         return view('treats');
     }

     public function septembed()
     {
         return view('septembed');
     }

     public function bag()
     {
         return view('bag');
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
