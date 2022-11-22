<?php
namespace App\Repositories\User;

use App\Models\User;
use App\Models\UserPreference;
use App\Models\UserEmailNotification;
use App\Models\Cart;
use App\Models\CartItems;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @var App\Models\User
     */
    public $user;

    /**
     * Create a new User repository instance.
     *
     * @param  App\Models\User $user
     * @return void
     */
    public function __construct(
        User $user
    ) {
        $this->user = $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Array $request
     * @return App\Models\User
     */
    public function store(array $request): User
    {
        $stp = 0;
        if (isset($request['account_type'])) {
            $stp = ($request['account_type'] == "1") ? 1 : 0;
        }

        // create user record
        $user = User::create([
            'name'        => $request['name'],
            'uuid'        => \Str::uuid()->toString(),
            'email'       => $request['email'],
            'city_id'     => (isset($request['city_id']) && ($request['city_id'] != "")) ? $request['city_id'] : null,
            'bio'         => $request['bio'] ?? null,
            'password'    => (isset($request['password'])) ? Hash::make($request['password']) : Hash::make('Seen@123'),
            'hire'        => ($request['hire']) ? 1 : 0,
            'collaborate' => ($request['collaborate']) ? 1 : 0,
            'stp'         => $stp,
            'phone'       => (isset($request['phone'])) ? $request['phone'] : null
        ]);

        // Sync user's categories
        $cat = [];
        if (isset($request['category_id'])) {
            foreach ($request['category_id'] as $key => $category) {
                if ($category) { $cat[] = $category; }
            }
            $user->categories()->sync($cat, false);
        }

        if (!isset($request['is_admin'])) {
            // To save default user preference
            $userPreference = UserPreference::create([
                'user_id' => $user->id
            ]);

            // To save default user email notifications
            $userEmailNotification = UserEmailNotification::create([
                'user_id' => $user->id
            ]);
        }

        return $user;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param array $request
     * @param int $id
     * @return User
     */
    public function update(array $request, int $id): User
    {
        $user = $this->user->findOrFail($id);
        $user->name = $request['name'];
        // $user->email = $request['email'];
        $user->city_id = $request['city_id'] ?? null;
        $user->bio = $request['bio'] ?? null;
        $user->profession_id = $request['profession_id'] ?? null;
        $user->facebook = $request['facebook'] ?? null;
        $user->twitter = $request['twitter'] ?? null;
        $user->instagram = $request['instagram'] ?? null;
        $user->youtube = $request['youtube'] ?? null;
        $user->behance = $request['behance'] ?? null;
        $user->update();

        return $user;
    }

    /**
     * Upload profile picture.
     *
     * @param array $request
     * @param int $id
     * @return User
     */
    public function uploadProfileImage(array $request, int $id): User
    {
        $user = $this->user->findOrFail($id);

        if (!is_null($user->profile_photo_path) && ($user->profile_photo_path != '')) {
            unlink(public_path('storage/'.$user->profile_photo_path));
        }

        $file = $request['avatar'];

        $name = md5($file . microtime()).'.'.$file->extension();
        $file->storeAs('public/avatars', $name);
        $user->profile_photo_path = 'avatars/'.$name;
        $user->save();

        return $user;
    }

    /**
     * Find specified resource in storage.
     *
     * @param int $id
     * @return User
     */
    public function find(int $id): User
    {
        return $this->user->findOrFail($id);
    }

    /**
     * Store data to cart.
     *
     * @param $request
     * @return App\Models\Cart
     */
    public function storeCart($request)
    {
        // Check record is exist or not
        $cart = Cart::where(['user_id' => Auth::user()->id, 'is_deleted' => 0])->first();
        if (empty($cart)) {
            $cart = new Cart;
        }

        $cart->user_id = Auth::user() ? Auth::user()->id : null;
        $cart->save();

        // Add cart item record
        $cartItem = new CartItems;
        $cartItem->cart_id = $cart->id;
        $cartItem->quantity = $request['quantity'];
        $cartItem->snapshot_package_id = $request['snapshot_package_id'];
        $cartItem->price = $request['price'];
        $cartItem->total = $request['price'];
        $cartItem->snapshot_id = $request['snapshot_id'];
        $cartItem->snapshot_package_user_id = $request['snapshot_package_user_id'];

        $cartItem->save();

        $cart->items_count = $cart->items_count + $request['quantity'];
        $cart->items_qty = $cart->items_qty + 1;
        $cart->sub_total = $cart->sub_total + $request['price'];
        $cart->grand_total = $cart->grand_total + $request['price'];
        $cart->save();

        return $cart;
    }

    /**
     * Get new users from storage
     *
     * @param int|null  $take
     */
    public function getNewUsers($take = null)
    {
        $currentDate = \Carbon\Carbon::now();
        $lastWeekDate = $currentDate->subDays(7);
        $users = $this->user->where('role_id', 1)
            ->where('created_at', '>', $lastWeekDate)
            ->orderBy('created_at', 'desc');
        if ($take) {
            $users = $users->take($take);
        }
        $users = $users->get();
        foreach ($users as $user) {
            $user->user_id = generateUserId($user->id);
        }
        return $users;
    }

    /**
     * Get count of new users from storage
     *
     * @return int
     */
    public function getNewUsersCount(): int
    {
        $currentDate = \Carbon\Carbon::now();
        $lastWeekDate = $currentDate->subDays(7);
        return $this->user->where('role_id', 1)
            ->where('created_at', '>',$lastWeekDate)
            ->count();
    }
}
