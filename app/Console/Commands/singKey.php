<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class singKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create-sing-key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create signKey and publicKey';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
