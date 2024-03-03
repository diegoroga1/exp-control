<?php

namespace Modules\Admin\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Nwidart\Modules\Facades\Module;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class InstallModuleAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'custom-module:admin-install';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Install module dependencies';

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
     * @return mixed
     */
    public function handle()
    {
        if ($this->option('init')) {
            return $this->initInstall(true);
        }

        $seeders = $this->confirm('¿Quieres ejecutar seeders?', false);

        $this->initInstall($seeders);
    }

    private function initInstall($withSeeders = true)
    {
        $steps = 1;

        $this->info('Installing Admin Module');

        $bar = $this->output->createProgressBar($withSeeders ? $steps + 1 : $steps);

        Artisan::call('migrate');

        if ($withSeeders) {
            $bar->advance();

            Artisan::call('module:seed Admin');
        }

        $bar->finish();

        $this->newLine();
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['init'],
        ];
    }
}
