<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Attribute;
use App\Models\Executor;
use App\Models\Role;
use App\Models\Service;
use App\Models\ServiceType;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Service::factory(10)->create();
        ServiceType::factory(10)->create();
        Role::factory(10)->create();
        Executor::factory(10)->create();
        Attribute::factory(10)->create();
    }
}
