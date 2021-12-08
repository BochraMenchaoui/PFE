<?php

namespace App\Http\Traits;

trait Alerts
{
    public function alert($eventName, $toBeDeleted)
    {
        $this->dispatchBrowserEvent($eventName, [
            'title'             => __('Are you sure?'),
            'text'              => __('The ') . __($toBeDeleted) . __(' will be deleted.'),
            'icon'              => 'error',
            'confirmButtonText' => __('Yes, Delete'),
            'cancelButtonText'  => __('No'),
        ]);
    }
}
