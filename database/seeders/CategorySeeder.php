<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->delete();
        DB::table('categories')->insert([
            [
                'name' => 'design',
                'slug' => 'design',
                'display_name' => 'Design',
                'parent_id' => 0,
                'banner' => 'assets/images/category-img/Category-Architecture-1.png'
            ],
            [
                'name' => 'events',
                'slug' => 'events',
                'display_name' => 'Events',
                'parent_id' => 0,
                'banner' => 'assets/images/category-img/Party-2.png'
            ],
            [
                'name' => 'health&wellness',
                'slug' => 'health&wellness',
                'display_name' => 'Health & Wellness',
                'parent_id' => 0,
                'banner' => 'assets/images/category-img/Health-5.png'
            ]
        ]);

        $categories = Category::pluck('id', 'name');

        DB::table('categories')->insert([
            [
                'name' => 'architecture',
                'slug' => 'architecture',
                'display_name' => 'Architecture',
                'parent_id' => $categories['design'],
                'banner' => 'assets/images/category-img/Category-Architecture-1.png'
            ],
            [
                'name' => 'balconydesign',
                'slug' => 'balconydesign',
                'display_name' => 'Balcony Design',
                'parent_id' => $categories['design'],
                'banner' => 'assets/images/category-img/Homepage 18.png'
            ],
            [
                'name' => 'cardetailing',
                'slug' => 'cardetailing',
                'display_name' => 'Car Detailing',
                'parent_id' => $categories['design'],
                'banner' => 'assets/images/category-img/Category-Car-Detailing-1.png'
            ],
            [
                'name' => 'carwrapping',
                'slug' => 'carwrapping',
                'display_name' => 'Car Wrapping',
                'parent_id' => $categories['design'],
                'banner' => 'assets/images/category-img/Category-Car-Detailing-1.png'
            ],
            [
                'name' => 'fashion',
                'slug' => 'fashion',
                'display_name' => 'Fashion',
                'parent_id' => $categories['design'],
                'banner' => 'assets/images/category-img/categories-images.png'
            ],
            [
                'name' => 'interiordesign',
                'slug' => 'interiordesign',
                'display_name' => 'Interior Design',
                'parent_id' => $categories['design'],
                'banner' => 'assets/images/category-img/Category-Interior-1.png'
            ],
            [
                'name' => 'kitchenwrapping',
                'slug' => 'kitchenwrapping',
                'display_name' => 'Kitchen Wrapping',
                'parent_id' => $categories['design'],
                'banner' => 'assets/images/category-img/Catering.png'
            ],
            [
                'name' => 'landscaping',
                'slug' => 'landscaping',
                'display_name' => 'Landscaping',
                'parent_id' => $categories['design'],
                'banner' => 'assets/images/category-img/design-1.png'
            ],
            [
                'name' => 'catering',
                'slug' => 'catering',
                'display_name' => 'Catering',
                'parent_id' => $categories['events'],
                'banner' => 'assets/images/category-img/Party-2.png'
            ],
            [
                'name' => 'childrensevents',
                'slug' => 'childrensevents',
                'display_name' => 'Children`s Events',
                'parent_id' => $categories['events'],
                'banner' => 'assets/images/category-img/Party-2.png'
            ],
            [
                'name' => 'entertainment',
                'slug' => 'entertainment',
                'display_name' => 'Entertainment',
                'parent_id' => $categories['events'],
                'banner' => 'assets/images/category-img/Party-1.png'
            ],
            [
                'name' => 'eventstaff',
                'slug' => 'eventstaff',
                'display_name' => 'Event Staff',
                'parent_id' => $categories['events'],
                'banner' => 'assets/images/category-img/Party-2.png'
            ],
            [
                'name' => 'homecinemaparties',
                'slug' => 'homecinemaparties',
                'display_name' => 'Home Cinema Parties',
                'parent_id' => $categories['events'],
                'banner' => 'assets/images/category-img/Learning-11.png'
            ],
            [
                'name' => 'winetasting',
                'slug' => 'winetasting',
                'display_name' => 'Wine Tasting',
                'parent_id' => $categories['events'],
                'banner' => 'assets/images/category-img/Party-2.png'
            ],
            [
                'name' => 'diet&nutrition',
                'slug' => 'diet&nutrition',
                'display_name' => 'Diet & Nutrition',
                'parent_id' => $categories['health&wellness'],
                'banner' => 'assets/images/category-img/Health-4.png'
            ],
            [
                'name' => 'meditation',
                'slug' => 'meditation',
                'display_name' => 'Meditation',
                'parent_id' => $categories['health&wellness'],
                'banner' => 'assets/images/category-img/Health-3.png'
            ],
            [
                'name' => 'personaltraining',
                'slug' => 'personaltraining',
                'display_name' => 'Personal Training',
                'parent_id' => $categories['health&wellness'],
                'banner' => 'assets/images/category-img/Health-5.png'
            ]
        ]);
    }
}
