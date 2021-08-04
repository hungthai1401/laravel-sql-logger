<?php

namespace HT\LaravelSqlLogger\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        \Illuminate\Database\Events\QueryExecuted::class => [
            \HT\LaravelSqlLogger\Listeners\OutputQueryLog::class,
        ],
        \Illuminate\Database\Events\TransactionBeginning::class => [
            \HT\LaravelSqlLogger\Listeners\OutputTransactionLog::class,
        ],
        \Illuminate\Database\Events\TransactionCommitted::class => [
            \HT\LaravelSqlLogger\Listeners\OutputTransactionLog::class,
        ],
        \Illuminate\Database\Events\TransactionRolledBack::class => [
            \HT\LaravelSqlLogger\Listeners\OutputTransactionLog::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
