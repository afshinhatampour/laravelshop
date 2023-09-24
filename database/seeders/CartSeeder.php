<?php

namespace Database\Seeders;

use App\Enums\CartStatusEnum;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Database\Seeder;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(User $user): void
    {
        Cart::create([
            'user_id' => $user->id,
            'status'  => CartStatusEnum::ACTIVE->value
        ]);
    }
}
