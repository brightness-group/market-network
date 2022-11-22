<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\City;
use App\Models\State;
use App\Models\UserPreference;
use App\Models\UserEmailNotification;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;

class Register extends Component
{
    use WithFileUploads;

    public $step;

    public $categories;

    public $cities;

    public $categorySelected;

    public $activeClass;

    public $avatar;

    public $form = [
        'name'            => '',
        'email'           => '',
        'password'        => '',
        'city_id'         => '',
        'avatar'          => '',
        'bio'             => '',
        'category_id'     => [],
        'hire'            => '',
        'collaborate'     => ''
    ];

    protected $validationAttributes = [
        'form.name'            => 'name',
        'form.email'           => 'email',
        'form.password'        => 'password',
        'form.city_id'         => 'location',
        'form.avatar'          => 'profile avatar',
        'form.bio'             => 'bio',
        'form.category_id'     => 'category',
        'form.hire'            => 'get hired',
        'form.collaborate'     => 'collaborate'
    ];


    public function render()
    {
        return view('livewire.register.register')
                ->layout('layouts.guest');
    }

    public function mount()
    {
        $this->step = 1;
        $this->categories = Category::where('parent_id', '<>', 0)->get();

        $this->cities = City::whereHas('state.country', function ($query) {
                            $query->where('id', 229);
                        })
                        -> with('state.country')
                        ->orderBy('cities.name')
                        ->get();
    }

    public function next()
    {
        if ($this->step == 1) {
            $this->validate([
                'form.name'     => 'required',
                'form.email'    => 'required|email|unique:users,email',
                'form.password' => 'required|min:8|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{6,}$/'
            ]);
        }

        if ($this->step == 2) {
            $this->validate([
                'form.category_id' => 'required'
            ]);
        }

        if ($this->step == 3) {
            $this->validate([
                'form.city_id' => 'required',
                'form.avatar'  => 'image|mimes:jpeg,png,jpg|max:2048',
                'form.bio'     => 'string'
            ]);
        }

        $this->step++;
    }

    public function skip()
    {
        // To skip third step
        $this->step++;
        // To skip next step and get registred
        $this->step++;
        $this->submit();
    }

    public function submit()
    {
        $this->validate([
            'form.hire'   => 'nullable',
            'form.collaborate' => 'nullable'
        ]);

        $userData = $this->form;

        // create user record
        $user = User::create([
            'name'        => $userData['name'],
            'uuid'        => \Str::uuid()->toString(),
            'email'       => $userData['email'],
            'city_id'     => (isset($userData['city_id']) && ($userData['city_id'] != "")) ? $userData['city_id'] : null,
            'bio'         => $userData['bio'] ?? null,
            'password'    => Hash::make($userData['password']),
            'hire'        => ($userData['hire']) ? 1 : 0,
            'collaborate' => ($userData['collaborate']) ? 1 : 0
        ]);
        
        // upload image in public folder
        if ($userData['avatar']) {
            $name = md5($userData['avatar'] . microtime()).'.'.$userData['avatar']->extension();

            $userData['avatar']->storeAs('public/avatars', $name);
            $user->profile_photo_path = 'avatars/'.$name;
            $user->save();
        }

        $cat = [];
        foreach ($userData['category_id'] as $key => $category) {
            if ($category) { $cat[] = $key; }
        }

        $user->categories()->sync($cat, false);
        
        // To create API token for user
        $token = $user->createToken($userData['email'])->plainTextToken;

        // To save default user prefences
        $userPreference = UserPreference::create([
            'user_id'     => $user->id
        ]);

        // To save default user email notifications
        $userEmailNotification = UserEmailNotification::create([
            'user_id'     => $user->id
        ]);

        return redirect()->route('dashboard', $user);
    }
}
