<?php

namespace HT\LaravelSqlLogger\Providers;

use HT\LaravelSqlLogger\Listeners\OutputQueryLog;
use HT\LaravelSqlLogger\Listeners\OutputTransactionLog;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Database\Events\TransactionCommitted;
use Illuminate\Database\Events\TransactionRolledBack;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        QueryExecuted::class => [
            OutputQueryLog::class,
        ],
        TransactionBeginning::class => [
            OutputTransactionLog::class,
        ],
        TransactionCommitted::class => [
            OutputTransactionLog::class,
        ],
        TransactionRolledBack::class => [
            OutputTransactionLog::class,
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
