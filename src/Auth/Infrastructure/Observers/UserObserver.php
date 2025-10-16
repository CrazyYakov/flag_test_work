<?php

namespace Marketplace\Auth\Infrastructure\Observers;

use App\Models\User;

class UserObserver
{
    public function created(User $user): void
    {
        $user->cart()->create();
    }

    public function deleted(User $user): void
    {
        $user->cart()->delete();
    }
}
