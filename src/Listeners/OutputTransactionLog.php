<?php

namespace HT\LaravelSqlLogger\Listeners;

use Illuminate\Database\Events\ConnectionEvent;

/**
 * Output Transaction Log
 *
 * @package App\Listeners
 */
class OutputTransactionLog
{
    /**
     * Handle the event.
     *
     * @param ConnectionEvent $event
     * @internal param $query
     * @internal param $bindings
     * @internal param $time
     */
    public function handle(ConnectionEvent $event): void
    {
        if ($event instanceof \Illuminate\Database\Events\TransactionBeginning) {
            $query = 'start transaction';
        } else if ($event instanceof \Illuminate\Database\Events\TransactionCommitted) {
            $query = 'commit';
        } else if ($event instanceof \Illuminate\Database\Events\TransactionRolledBack) {
            $query = 'rollback';
        } else {
            $query = get_class($event);
        }
        app('log')->driver('sqllog')->debug($query);
    }
}
