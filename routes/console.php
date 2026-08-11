<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment('SIRAPOS');
});

Schedule::command('reminder:send')
    ->everyMinute();
