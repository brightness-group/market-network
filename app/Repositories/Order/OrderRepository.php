<?php

namespace App\Repositories\Order;

use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{
    /**
     * @var App\Models\Order
     */
    public $order;

    /**
     * Create a new Order repository instance.
     *
     * @param App\Models\Order $order
     * @return void
     */
    public function __construct(
        Order $order
    )
    {
        $this->order = $order;
    }

    /**
     * Get count of new orders from storage
     *
     * @return int
     */
    public function getNewOrdersCount(): int
    {
        $currentDate = \Carbon\Carbon::now();
        $lastWeekDate = $currentDate->subDays(7);
        return $this->order->where('created_at', '>', $lastWeekDate)
            ->get()
            ->count();
    }
}
