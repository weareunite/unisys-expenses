<?php

namespace Unite\Expenses;

use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;
use Unite\Expenses\Console\Commands\Install;

class ExpensesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     */
    public function boot()
    {
        $this->commands([
            Install::class,
        ]);

        $this->loadRoutesFrom(__DIR__.'/Routes/api.php');

        if (! class_exists('CreateExpensesTables')) {
            $timestamp = date('Y_m_d_His', time());

            $this->publishes([
                __DIR__.'/../database/migrations/create_expenses_tables.php.stub' => database_path("/migrations/{$timestamp}_create_expenses_tables.php"),
            ], 'migrations');
        }

        Event::subscribe(ItemSubscriber::class);
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
    }
}
