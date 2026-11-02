<?php

namespace Tests\Feature\Order\Presentation\Command;

use Illuminate\Testing\PendingCommand;
use Symfony\Component\Console\Command\Command;
use Tests\TestCase;

class CancelOrderCommandTest extends TestCase
{
    public function test_console_command(): void
    {
        $command = $this->artisan('app:cancel-order');
        assert($command instanceof PendingCommand);

        $command->assertExitCode(Command::SUCCESS);
    }
}
