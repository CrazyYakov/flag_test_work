<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $onPaymentStatus = new Status();
        $onPaymentStatus->title = "На оплату";
        $onPaymentStatus->slug = "on_payment";
        $onPaymentStatus->save();

        $paidStatus = new Status();
        $paidStatus->title = "Оплачено";
        $paidStatus->slug = "paid";
        $paidStatus->save();

        $cancelledStatus = new Status();
        $cancelledStatus->title = "Отменен";
        $cancelledStatus->slug = "cancelled";
        $cancelledStatus->save();
    }
}
