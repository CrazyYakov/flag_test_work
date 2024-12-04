<?php

namespace App\Services\Repositories;

use App\Models\Status;

class StatusRepository implements Interfaces\StatusRepositoryInterface
{

    public function getCancelledStatus(): Status
    {
        return Status::query()->where('slug', 'cancelled')->firstOrFail();
    }

    public function getPaidStatus(): Status
    {
        return Status::query()->where('slug', 'paid')->firstOrFail();
    }

    public function getOnPaymentStatus(): Status
    {
        return Status::query()->where('slug', 'on_payment')->firstOrFail();
    }
}
