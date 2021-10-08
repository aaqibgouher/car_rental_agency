<?php

namespace App\Utilities;

use Carbon\Carbon;
use App\Utilities\Constant;

class Common
{

    public static function now()
    {
        return date("Y-m-d H:i:s");
    }

    // public static function datetime($datetime)
    // {
    //     if (!$datetime) return "";

    //     $datetime = Carbon::parse($datetime)->format(Constant::get("datetime.default_format"));
    //     return $datetime;
    // }

    // public static function datetime_format($datetime, $format = "")
    // {
    //     if (!$datetime) return "";
    //     if (!$format) $format = Constant::get("datetime.default_readable_format");
    //     $datetime = Carbon::parse($datetime)->format($format);
    //     return $datetime;
    // }

    // public static function datetime_format_frontend($datetime)
    // {
    //     $format = Constant::get("datetime.default_frontend_format");
    //     return Common::datetime_format($datetime, $format);
    // }
}
