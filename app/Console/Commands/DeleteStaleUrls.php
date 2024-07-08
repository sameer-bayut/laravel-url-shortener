<?php

namespace App\Console\Commands;

use App\Models\Url;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteStaleUrls extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-stale-urls';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete URLS not visited in the last 30 days';


    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $thresholdDate = Carbon::now()->subDays(30);
        Url::where('last_visited_at', '<', $thresholdDate)
                                ->orWhereNull('last_visited_at')
                                ->delete();

        $this->info('Old URLs deleted successfully.');
    }
}
