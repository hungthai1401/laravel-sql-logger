<?php

namespace HT\LaravelSqlLogger\Listeners;

use DB;
use DateTime;
use Illuminate\Database\Events\QueryExecuted;

/**
 * Output Query Log
 *
 * @package App\Listeners
 */
class OutputQueryLog
{
    /**
     * Handle the event.
     *
     * @param QueryExecuted $event
     * @internal param $query
     * @internal param $bindings
     * @internal param $time
     */
    public function handle(QueryExecuted $event): void
    {
        $time = $event->time;
        $bindings = $event->bindings;
        foreach ($bindings as $i => $binding) {
            if ($binding instanceof DateTime) {
                $bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
            } elseif (is_string($binding)) {
                $bindings[$i] = DB::getPdo()->quote($binding);
            } elseif (null === $binding) {
                $bindings[$i] = 'null';
            }
        }
        $query = str_replace(array('%', '?', "\r", "\n", "\t"), array('%%', '%s', ' ', ' ', ' '), $event->sql);
        $query = preg_replace('/\s+/uD', ' ', $query);
        $query = vsprintf($query, $bindings).';';

        app('log')->driver('sqllog')->debug($query, compact('time'));
    }
}
