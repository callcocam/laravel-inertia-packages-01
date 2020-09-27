<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Role;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::query()->forceDelete();
        Company::query()->forceDelete();
        Tenant::query()->forceDelete();
        Role::query()->forceDelete();
        //for ($i=1;$i<=5;$i++):
        Tenant::factory()->create([
            // 'name'=>sprintf("%s-%s",request()->getHost(), str_pad($i, 2,'0',STR_PAD_LEFT)),
            'name'=>request()->getHost(),
            'created_at'=>today(),
            'updated_at'=>today()
        ])->each(function ($tenant){
            Company::factory(1)->create([
                'name'=>Str::title($tenant->name)
            ])->each(function ($company) use ($tenant){
                $company->tenants()->sync($tenant->id);

                if(!User::query()->where('email',sprintf("super-admin@%s.test",$tenant->name))->first())
                {
                    User::factory(1)->create(
                        [
                            'name'=>sprintf("Usuário %s",Str::title($tenant->name)),
                            'email'=>sprintf("super-admin@%s.test",$tenant->name),

                        ]
                    )->each(function (User $user) use ($tenant,$company){
                      $role =   $user->roles()->create([
                            'name'=>"Super Admin",
                            'slug'=>'super-admin',
                            'description'=>'Administrador Geral',
                            'special'=>'all-access'
                        ]);
                        $role->tenants()->sync($tenant->id);
                        $user->companies()->sync($company->id->toString());
                        $user->tenants()->sync($tenant->id);
                    });
                }

            });
        });
    }
}
