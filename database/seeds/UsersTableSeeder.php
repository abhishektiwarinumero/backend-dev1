<?php

use App\User;
use App\Order;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
            'username' => 'Admin',
            'first_name' => 'King',
            'last_name' => 'Boosting',
            'email' => 'admin@kingboosting.com',
            'email_verified_at' => now(),
            'password' => bcrypt('*iUJA2m%Ey67')
        ]);
        // Create 25 boosters
        // We need to seed boosters first because they handle orders
        // Boosters don't create orders, except they do
        factory(User::class, 25)->create()->each(function ($booster) use ($admin) {
            // Admin has 25 orders
            $admin->orders()->create(factory(Order::class)->make(['booster_id' => $booster->id])->toArray());
            $booster->assignRole('Booster');
            // Create 50 members
            factory(User::class, 2)->create()->each(function ($client) use ($booster) {
                $client->assignRole('Member');
                $client->orders()->createMany(factory(Order::class, rand(3, 20))->make(['booster_id' => $booster->id])->toArray());
            });

            // Create 5 moderators
            factory(User::class, 5)->create()->each(function ($user) use ($booster) {
                $user->assignRole('Moderator');
                $user->orders()->createMany(factory(Order::class, rand(3, 20))->make(['booster_id' => $booster->id])->toArray());
            });
        });
        // 25 boosters exchange orders
        // factory(User::class, 25)->create()->each(function ($user) {
        //     $user->assignRole('Booster');
        //     $user->jobs()->createMany(factory(Order::class, rand(3, 20))->make()->toArray());
        // });
    }
}
