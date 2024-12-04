<?php

namespace App\Services\Repositories\Interfaces;

use App\Models\Status;

interface StatusRepositoryInterface
{
    public function getCancelledStatus(): Status;

    public function getPaidStatus(): Status;

    public function getOnPaymentStatus(): Status;
}
