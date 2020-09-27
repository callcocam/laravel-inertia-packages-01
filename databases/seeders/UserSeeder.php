<?php

namespace Database\Seeders;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $tenant =  Tenant::query()->where('name',request()->getHost())->first();
        User::factory(500)->create()->each(function ($user) use ($tenant){
            $user->tenants()->sync($tenant->id);
        });
    }
}
