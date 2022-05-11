<?php namespace Waqar\Utility;

use Illuminate\Support\Str;

class Helper
{
    public static function dashboardStatsQuery($table, $operation, $column, $extra_wheres = '', $method = 'weekly', $dates = [])
    {
        if ($method == 'manual') {
            if ($dates) {
                $from = $dates['from'] ?? date('Y-m-d');
                $to = $dates['to'] ?? date('Y-m-d');
                $past_from = $dates['past_from'] ?? date('Y-m-d', strtotime('-1 day'));
                $past_to = $dates['past_to'] ?? date('Y-m-d', strtotime('-1 day'));
            }
        }

        if ($method != 'manual' || count($dates) == 0) {
            switch ($method) {
                case "daily":
                    $from = $to = date('Y-m-d');
                    $past_from = $past_to = date('Y-m-d', strtotime('-1 day'));
                    break;
                case "monthly":
                    $from = date('Y-m-01');
                    $to = date('Y-m-t');
                    $past_from = date('Y-m-01', strtotime('-1 month'));
                    $past_to = date('Y-m-t', strtotime('-1 month'));
                    break;
                case "yearly":
                    $from = date('Y-01-01');
                    $to = date('Y-m-d');
                    $past_from = date('Y-01-01', strtotime('-1 year'));
                    $past_to = date('Y-12-31', strtotime('-1 year'));
                    break;
                default:
                    $from = date('Y-m-d', strtotime('-6 days'));
                    $to = date('Y-m-d');
                    $past_from = date('Y-m-d', strtotime('-13 days'));
                    $past_to = date('Y-m-d', strtotime('-7 days'));
            }
        }


        $query = "SELECT
                @past:= (SELECT IFNULL($operation($column),0) FROM $table WHERE DATE(created_at) BETWEEN '$past_from' AND '$past_to' $extra_wheres) past,
                @this:= (SELECT IFNULL($operation($column),0) FROM $table WHERE DATE(created_at) BETWEEN '$from' AND '$to' $extra_wheres) this,
                @total:= IFNULL(@this+@past,1),
                ROUND((@this-@past)/(@total)*100,1) AS 'percent'";
        return $query;
    }

    public function storeImage($file, $path, $full_path = false)
    {
        $image_name = Str::random() . time() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $image_name);
        return $full_path ? public_path($path . "/" . $image_name) : $image_name;
    }

    public function updateImage($file, $path, $old, $full_path = false)
    {
        if (file_exists(public_path($old))) {
            unlink(public_path($old));
        }
        $image_name = Str::random() . time() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $image_name);
        return $full_path ? public_path($path . "/" . $image_name) : $image_name;
    }

}
