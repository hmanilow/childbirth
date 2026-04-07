<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('model:prune')->dailyAt('03:10');
Schedule::command('media:cleanup-unused')->dailyAt('03:30')->withoutOverlapping();
