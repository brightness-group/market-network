<?php

namespace App\Repositories\Order;

interface OrderRepositoryInterface
{
    /**
     * Get count of new orders from storage
     *
     * @return int
     */
    public function getNewOrdersCount(): int;

}
