<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class EventService
{
    public static function checkEventDuplication($eventDate, $startTime, $endTime)
    {
        return DB::table('events')
        ->whereDate('start_date', $eventDate)
        ->whereTime('end_date', '>', $startTime) // カラム値 , operator , requestの値の順
        ->whereTime('start_date', '<', $endTime)
        ->exists();
    }

    public static function countEventDuplication($eventDate, $startTime, $endTime)
    {
        return DB::table('events')
        ->whereDate('start_date', $eventDate)
        ->whereTime('end_date', '>', $startTime) // カラム値 , operator , requestの値の順
        ->whereTime('start_date', '<', $endTime)
        ->count();
    }

    public static function joinDateAndTime($date, $time)
    {
        $join = $date . " " . $time;
        return Carbon::createFromFormat('Y-m-d H:i', $join);
    }

    public static function getWeekEvents($startDate , $endDate)
    {
        // 定員数を求めるSQLクエリを格納(キャンセルされた人数を除く)
        $reservedPeople = DB::table('reservations')
        ->select('event_id', DB::raw('sum(number_of_people) as number_of_people'))
        ->whereNull('canceled_date')
        ->groupBy('event_id');

        return DB::table('events')
        ->leftJoinSub($reservedPeople, 'reservedPeople',
        function($join){
        $join->on('events.id', '=', 'reservedPeople.event_id');
        })
        ->whereBetween('events.start_date', [$startDate , $endDate])
        ->orderBy('events.start_date', 'asc')
        ->get();
    }
}
