<?php
namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    /**
     * Store a newly created resource in storage.
     *
     * @param Array $request
     * @return App\Models\User
     */
    public function store(Array $request): User;

    /**
     * Update the specified resource in storage.
     *
     * @param Array $request
     * @param  int  $id
     * @return App\Models\User
     */
    public function update(Array $request, int $id): User;

    /**
     * Find specified resource in storage.
     *
     * @param  int  $id
     * @return App\Models\User
     */
    public function find(int $id): User;

    /**
     * Get new users from storage.
     *
     * @param int|null $take
     */
    public function getNewUsers(int $take = null);

    /**
     * Get new users count from storage.
     *
     * @return int
     */
    public function getNewUsersCount(): int;
}
