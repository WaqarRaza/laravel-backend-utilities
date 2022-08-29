<?php namespace Waqar\Utility;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class Utility
{
    public function dashboard_stats_query(string $table, string $operation, string $column, string $extra_wheres = '', string $method = 'weekly', array $dates = []): string
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


        return "SELECT
                @past:= (SELECT IFNULL($operation($column),0) FROM $table WHERE DATE(created_at) BETWEEN '$past_from' AND '$past_to' $extra_wheres) past,
                @this:= (SELECT IFNULL($operation($column),0) FROM $table WHERE DATE(created_at) BETWEEN '$from' AND '$to' $extra_wheres) this,
                @total:= IFNULL(@this+@past,1),
                ROUND((@this-@past)/(@total)*100,1) AS 'percent'";
    }

    public function store_image(UploadedFile $file, string $path, bool $return_full_path = false): string
    {
        $image_name = Str::random() . time() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $image_name);
        return $return_full_path ? public_path($path . "/" . $image_name) : $image_name;
    }

    public function update_image(UploadedFile $file, string $path, string $old, bool $return_full_path = false): string
    {
        if (file_exists(public_path($old))) {
            unlink(public_path($old));
        }
        $image_name = Str::random() . time() . '.' . $file->getClientOriginalExtension();
        $file->move($path, $image_name);
        return $return_full_path ? public_path($path . "/" . $image_name) : $image_name;
    }
}
