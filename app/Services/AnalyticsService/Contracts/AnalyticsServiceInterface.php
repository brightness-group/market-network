<?php

namespace App\Services\AnalyticsService\Contracts;

interface AnalyticsServiceInterface
{
    public function getAnalyticsDetails(string $type = 'day');

}
