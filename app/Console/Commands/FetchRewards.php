<?php

namespace App\Console\Commands;

use App\TiltifyClient;
use Illuminate\Console\Command;

class FetchRewards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:fetch-rewards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Rewards from Tiltify';

    /**
     * Execute the console command.
     */
    public function handle(TiltifyClient $client)
    {
        $client->getRewards();
    }
}
