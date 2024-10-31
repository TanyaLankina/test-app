<?php

namespace Database\Factories;

use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @extends Factory<Order>
 */
class OrderFactory extends Factory
{
    use HasFactory;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $createdAt = $this->faker->dateTimeBetween('-3 months');
        return [
            'status' => $this->faker->randomElement(OrderStatusEnum::values()),
            'user_id' => User::query()->inRandomOrder()->first()->id,
            'created_at' => $createdAt,
            'updated_at' => $createdAt,
        ];
    }
}
