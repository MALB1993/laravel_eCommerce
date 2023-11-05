<?php
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;


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


function convertShamsiToGeographical($shamsi)
{
    if($shamsi == null)
    {
        return null;
    }

    $pattern = "/[-\s]/";
    $shamsiDate = preg_split($pattern, $shamsi);
    $date = $shamsiDate[0]."-".$shamsiDate[1]."-".$shamsiDate[2]." ".$shamsiDate[3];
    return Verta::parse($date)->datetime();
}
