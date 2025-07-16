<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class AssignRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Ambil role & permission dari DB
        $admin = Role::where('name', 'admin')->first();
        $editor = Role::where('name', 'editor')->first();
        $userRole = Role::where('name', 'user')->first();

        $allPermissions = Permission::all();

        // Assign all permissions to admin
        $admin->permissions()->sync($allPermissions->pluck('id'));

        // Assign some to editor
        $editor->permissions()->sync(
            $allPermissions->whereIn('name', ['create-post', 'edit-post'])->pluck('id')
        );

        // User biasa cuma bisa view
        $userRole->permissions()->sync(
            $allPermissions->where('name', 'view-post')->pluck('id')
        );

        // Assign roles ke user
        $user1 = User::where('email', 'admin1@mail.com')->first();
        $user2 = User::where('email', 'admin2@mail.com')->first();

        if ($user1) {
            $user1->roles()->sync([$admin->id]);
        }

        if ($user2) {
            $user2->roles()->sync([$editor->id]);
        }

        $this->command->info('Roles and permissions assigned to users.');
    }
}
