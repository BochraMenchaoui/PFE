<?php

namespace App\Http\Traits;

trait Stats
{
    public function makeStats($data)
    {
        $initalStats = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

        for ($i = 0; $i <= sizeof($initalStats); $i++) {
            if (array_key_exists($i, $data)) {
                $initalStats[$i - 1] = $data[$i];
            }
        }
        return $initalStats;
    }


    public function calculateGrowth($thisMonth, $lastMonth)
    {
        if ($lastMonth > 0) {
            return round((($thisMonth - $lastMonth) / $lastMonth) * 100, 1);
        }
        return 100;
    }
}
