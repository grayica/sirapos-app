<?php

use App\Models\ActivityLog;
use App\Models\Notification;

if (! function_exists('activity_log')) {

    function activity_log(
        string $module,
        string $activity,
        ?string $description = null
    ) {

        if (! auth()->check()) {
            return;
        }

        ActivityLog::create([

            'user_id' => auth()->id(),

            'module' => $module,

            'activity' => $activity,

            'description' => $description,

            'ip_address' => request()->ip(),

        ]);
    }

if (!function_exists('notify_user')) {

        function notify_user(
            $userId,
            $title,
            $message,
            $type = 'info'
        ) {

            Notification::create([

                'user_id' => $userId,

                'title' => $title,

                'message' => $message,

                'type' => $type,

            ]);
        }
    }
}
