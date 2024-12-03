<?php

use App\Console\Commands\CancelOrderCommand;
use Illuminate\Support\Facades\Schedule;

Schedule::command(CancelOrderCommand::class)->everySecond();
