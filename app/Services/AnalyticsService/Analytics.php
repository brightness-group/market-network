<?php


namespace App\Services\AnalyticsService;

use App\Models\Order;
use App\Models\Snapshot;
use App\Models\User;
use App\Services\AnalyticsService\Contracts\AnalyticsServiceInterface;

class Analytics implements AnalyticsServiceInterface
{
    /**
     * @var App\Models\Snapshot
     */
    public $snapshot;

    /**
     * @var App\Models\User
     */
    public $user;

    /**
     * @var App\Models\Order
     */
    public $order;

    /**
     * Create a  Analytics instance.
     *
     * @param App\Models\User $user
     * @param App\Models\Snapshot $snapshot
     * @param App\Models\Order $order
     * @return void
     */
    public function __construct(
        Snapshot $snapshot,
        User $user,
        Order $order
    )
    {
        $this->snapshot = $snapshot;
        $this->user = $user;
        $this->order = $order;
    }

    // public functions . . . . . . .

    public function getAnalyticsDetails(string $type = 'day'): array
    {
        $data['applied_input'] = $type;
        $dates = $this->getStartAndEndDates($type);

        // 1. prepare seen analytics
        $snapshots = $this->snapshot
            ->whereBetween('created_at', [$dates['first_date_start'], $dates['first_date_end']])
            ->count();
        $snapshots2 = $this->snapshot
            ->whereBetween('created_at', [$dates['second_date_start'], $dates['second_date_end']])
            ->count();
        $data['total_seen'] = $snapshots;
        $data['total_seen_percentage'] = percentChange($snapshots2, $snapshots);
        $data['total_seen_percentage_class'] = getClass($data['total_seen_percentage']);

        // 2. prepare users analytics
        $users = $this->user->where('role_id', 1);
        $users = $users->whereBetween('created_at', [$dates['first_date_start'], $dates['first_date_end']]);
        $users = $users->count();
        $users2 = $this->user->where('role_id', 1);
        $users2 = $users2->whereBetween('created_at', [$dates['second_date_start'], $dates['second_date_end']]);
        $users2 = $users2->count();
        $data['total_users'] = $users;
        $data['total_users_percentage'] = percentChange($users2, $users);
        $data['total_users_percentage_class'] = getClass($data['total_users_percentage']);

        // 3. prepare revenues analytics
        $revenues = $this->order
            ->whereBetween('created_at', [$dates['first_date_start'], $dates['first_date_end']])
            ->get();
        $revenues = collect($revenues)->sum('grand_total');
        $revenues2 = $this->order
            ->whereBetween('created_at', [$dates['second_date_start'], $dates['second_date_end']])
            ->get();
        $revenues2 = collect($revenues)->sum('grand_total');
        $data['total_revenues'] = $revenues;
        $data['total_revenues_percentage'] = percentChange($revenues2, $revenues);
        $data['total_revenues_percentage_class'] = getClass($data['total_revenues_percentage']);

        // 4. prepare bounce rate analytics
        $data['total_bounce_rate'] = 0;
        $data['total_bounce_rate_percentage'] = 0;
        $data['total_bounce_rate_percentage_class'] = getClass(0);

        return $data;
    }


    // private functions . . . . . . .

    private function getStartAndEndDates(string $type = 'day')
    {
        if ($type == 'week') {
            $data['first_date_start'] = now()->subDays(6)->format('Y-m-d') . " 00:00:00";
            $data['first_date_end'] = now()->format('Y-m-d') . " 23:59:59";
            $data['second_date_start'] = now()->subDays(13)->format('Y-m-d') . " 00:00:00";
            $data['second_date_end'] = now()->subDays(7)->format('Y-m-d') . " 23:59:59";
        } else if ($type == 'month') {
            $data['first_date_start'] = now()->subMonths(1)->format('Y-m-d') . " 00:00:00";
            $data['first_date_end'] = now()->format('Y-m-d') . " 23:59:59";
            $data['second_date_start'] = now()->subDays(1)->subMonths(2)->format('Y-m-d') . " 00:00:00";
            $data['second_date_end'] = now()->subDays(1)->subMonths(1)->format('Y-m-d') . " 23:59:59";
        } else {
            $data['first_date_start'] = now()->format('Y-m-d') . " 00:00:00";
            $data['first_date_end'] = now()->format('Y-m-d') . " 23:59:59";
            $data['second_date_start'] = now()->subDays(1)->format('Y-m-d') . " 00:00:00";
            $data['second_date_end'] = now()->subDays(1)->format('Y-m-d') . " 23:59:59";
        }
        return $data;
    }

}
