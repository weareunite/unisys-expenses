<?php

namespace Unite\Expenses\Console\Commands;

use Illuminate\Console\Command;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unisys-api:expenses:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install Expenses module to Unisys API';

    /*
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Installing ...');

        $this->install();

        $this->info('UniSys module was installed');
    }

    private function install()
    {
        $this->call('vendor:publish', [
            '--provider' => 'Unite\\Expenses\\ExpensesServiceProvider'
        ]);

        $this->call('migrate');
    }
}