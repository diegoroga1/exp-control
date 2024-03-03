<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InnocoreInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'innocore:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install core';

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
        $this->newLine(2);
        $bar = $this->output->createProgressBar(2);
        Artisan::call('migrate');
        $bar->advance(1);
        Artisan::call('db:seed');
        $bar->finish();
        $this->newLine();
        $this->line('------- END INSTALLATION -------');
        $this->newLine(2);
        return self::SUCCESS;
    }
}
