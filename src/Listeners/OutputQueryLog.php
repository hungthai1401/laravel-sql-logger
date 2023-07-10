<?php

namespace HT\LaravelSqlLogger\Listeners;

use DateTimeInterface;
use DB;
use Illuminate\Database\Events\QueryExecuted;

/**
 * Output Query Log
 *
 * @package HT\LaravelSqlLogger\Listeners
 */
class OutputQueryLog
{
    /**
     * Handle the event.
     *
     * @param QueryExecuted $event
     */
    public function handle(QueryExecuted $event): void
    {
        $time = $event->time;
        $bindings = $event->bindings;
        foreach ($bindings as $i => $binding) {
            if ($binding instanceof DateTimeInterface) {
                $bindings[$i] = $binding->format('\'Y-m-d H:i:s\'');
            } elseif (is_string($binding)) {
                $bindings[$i] = DB::getPdo()->quote($binding);
            } elseif (is_bool($binding)) {
                $bindings[$i] = $binding ? '1' : '0';
            } elseif (null === $binding) {
                $bindings[$i] = 'null';
            }
        }
        $query = str_replace(['%', '?', "\r", "\n", "\t"], ['%%', '%s', ' ', ' ', ' '], $event->sql);
        $query = preg_replace('/\s+/uD', ' ', $query);
        $query = vsprintf($query, $bindings) . ';';
        app('log')->driver('sqllog')->debug($query, compact('time'));
        if (! config('logging.channels.slow_query_log.enabled')) {
            return;
        }

        $log_queries_slower_than = (float) config('logging.channels.slow_query_log.time_to_log', -1);
        if ($log_queries_slower_than < 0 || $time < ($log_queries_slower_than * 1000)) {
            return;
        }

        $level = config('logging.channels.slow_query_log.log_level', 'debug');
        app('log')->driver('slow_query_log')->log($level, $query, compact('time'));
    }
}
