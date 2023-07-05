<?php

namespace HT\LaravelSqlLogger\Listeners;

use Illuminate\Database\Events\ConnectionEvent;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Database\Events\TransactionCommitted;
use Illuminate\Database\Events\TransactionRolledBack;

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
     */
    public function handle(ConnectionEvent $event): void
    {
        if ($event instanceof TransactionBeginning) {
            $query = 'start transaction';
        } elseif ($event instanceof TransactionCommitted) {
            $query = 'commit';
        } elseif ($event instanceof TransactionRolledBack) {
            $query = 'rollback';
        } else {
            $query = get_class($event);
        }
        app('log')->driver('sqllog')->debug($query);
    }
}
