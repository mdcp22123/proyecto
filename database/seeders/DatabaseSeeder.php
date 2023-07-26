<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Billing;
use App\Models\Detail;
use App\Models\Patient;
use App\Models\Proof;
use App\Models\Sale;
use App\Models\Service;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
           'email' => 'marlon@gmail.com',
           'password'=>'$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi'
       ]);

       Patient::factory(50)->create();
      Service::factory(4)->create();

       /*  Sale::factory(20)->create();
       Detail::factory(5)->create();
       Proof::factory(10)->create();  */
    }
}
