<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Marketplace\Order\Core\Domain\Values\Enums\OrderStatusEnum;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (OrderStatusEnum::cases() as $orderStatus) {
            Status::query()->firstOrCreate(
                [
                    'slug' => $orderStatus->value,
                ],
                [
                    'title' => $orderStatus->label(),
                ]
            );
        }
    }
}
