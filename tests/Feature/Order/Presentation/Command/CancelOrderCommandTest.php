<?php

namespace Tests\Feature\Order\Presentation\Command;

use Symfony\Component\Console\Command\Command;
use Tests\TestCase;

class CancelOrderCommandTest extends TestCase
{
    public function test_console_command()
    {
        $this->artisan('app:cancel-order')
            ->assertExitCode(Command::SUCCESS);
    }
}
