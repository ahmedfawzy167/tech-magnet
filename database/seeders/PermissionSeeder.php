<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(["name"=>"view-courses"]);
        Permission::create(["name"=>"view-categories"]);
        Permission::create(["name"=>"view-courseMaterial"]);
        Permission::create(["name"=>"view-courseRecordings"]);
        Permission::create(["name"=>"add-projects"]);
        Permission::create(["name"=>"send-supportRequest"]);
        Permission::create(["name"=>"add-projects"]);
        Permission::create(["name"=>"view-quiz"]);
        Permission::create(["name"=>"view-assignments"]);
        Permission::create(["name"=>"create-courseMaterial"]);
        Permission::create(["name"=>"create-onlineMeetings"]);
        Permission::create(["name"=>"view-support-requests"]);
        Permission::create(["name"=>"create-quizs"]);
        Permission::create(["name"=>"create-assignments"]);
        Permission::create(["name"=>"create-attendance"]);
        Permission::create(["name"=>"update-attendance"]);
        Permission::create(["name"=>"view-projects"]);
        Permission::create(["name"=>"view-studentProfiles"]);

    }
}
