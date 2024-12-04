<?php

namespace Commands;

use Illuminate\Console\Command;
use Tests\TestCase;

class CancelOrderCommandTest extends TestCase
{
    public function test_console_command()
    {
        $this->artisan('app:cancel-order')->assertExitCode(Command::SUCCESS);
    }
}
