<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Ad;
use App\Models\User;
use App\Models\Category;
use App\Models\City;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ad>
 */
class AdFactory extends Factory
{
     protected $model = Ad::class;
    /**
     * Define the model's default state.
     * 
     *
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'title'=>$this->faker->sentence,
        'slug'=>Str::slug($this->faker->unique()->sentence),
        'short_desc'=>$this->faker->text(100),
        'description'=>$this->faker->paragraph,
        
        'user_id'=>User::inRandomOrder()->first()?->id ?? User::factory(),
        'price'=>$this->faker->numberBetween(10000,100000000000),
        'status'=>\App\Enums\AdStatus::Pending->value,
        'is_featured'=>$this->faker->boolean,
        'views'=>$this->faker->numberBetween(0, 1000),
        'price_type'=>\App\Enums\Price_typeStatus::Negotiable->value,
        'expired_at'=>now()->addDays(rand(10, 30)),
        'category_id' => Category::inRandomOrder()->first()?->id ?? Category::factory(),
        // 'city_id' => City::inRandomOrder()->first()?->id ?? City::factory(),
         'contact_number' => $this->faker->phoneNumber,
        ];
    }
}
