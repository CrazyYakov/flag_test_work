<?php

use Illuminate\Support\Facades\Schedule;
use Marketplace\Order\Presentation\Commands\CancelOrderCommand;


Schedule::command(CancelOrderCommand::class)->everySecond();
