<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteOldOpp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-opportunities';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete opportunities older than 30 days.';

    /**
     * Execute the console command.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // 1 minute from the present time

    }
}
