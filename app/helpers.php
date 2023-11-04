<?php
use Carbon\Carbon;


function generateFileName($name)
{
    $year         = Carbon::now()->year;
    $month        = Carbon::now()->month;
    $hour         = Carbon::now()->hour;
    $minute       = Carbon::now()->minute;
    $second       = Carbon::now()->second;
    $microSecond  = Carbon::now()->microsecond;

    return $year ."_". $month ."_". $hour ."_". $minute ."_". $second ."_". $microSecond ."_". $name;
}
