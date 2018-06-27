<?php

namespace Unite\Expenses\Console\Commands;

use Unite\UnisysApi\Console\InstallModuleCommand;

class Install extends InstallModuleCommand
{
    protected $moduleName = 'expenses';

    protected function install()
    {
        $this->call('unisys-api:install:contacts');

        $this->call('unisys-api:install:transactions');

        $this->call('vendor:publish', [
            '--provider' => 'Unite\\Expenses\\ExpensesServiceProvider'
        ]);

        $this->call('migrate');
    }
}