<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = [ 'Physical', 'Digital' ];
        $cat_arr = ['Appliances', 'Computers', 'Electronics', 'Movies', 'Mobiles', 'Games'];

        return [
            'user_id' => $this->faker->randomElement(User::all())['id'],
            'title' => $this->faker->sentence(rand(5,10)),
            'image' => 'products/default_product.jpg',
            'summary' => $this->faker->paragraph(2, true),
            'description' => $this->faker->paragraph(5, true),
            'category' => $cat_arr[array_rand($cat_arr, 1)],
            'type' => $types[array_rand($types, 1)],
            'owner_email' => $this->faker->randomElement(User::all())['email'],
            'expiry_date' => $this->faker->dateTimeBetween('+1 months','+12 months')
        ];
    }
}
