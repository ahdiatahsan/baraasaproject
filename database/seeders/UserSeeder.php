<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission as PermissionModel;
use Spatie\Permission\Models\Role as PermissionRole;
use Spatie\Permission\PermissionRegistrar;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        # Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        # Create permissions
        $permissions = [
            'dashboard-view',

            'division-view',
            'division-create',
            'division-update',
            'division-delete',

            'position-view',
            'position-create',
            'position-update',
            'position-delete',

            'blog-view',
            'blog-create',
            'blog-update',
            'blog-delete',

            'research-view',
            'research-create',
            'research-update',
            'research-delete',

            'thread-view',
            'thread-create',
            'thread-update',
            'thread-delete',

            'comment-view',
            'comment-create',
            'comment-update',
            'comment-delete',

            'event-view',
            'event-create',
            'event-update',
            'event-delete',

            'participant-view',
            'participant-create',
            'participant-update',
            'participant-delete',

            'recruitment-view',
            'recruitment-create',
            'recruitment-update',
            'recruitment-delete',

            'member-view',
            'member-create',
            'member-update',
            'member-delete',

            'general-view',
            'general-create',
            'general-update',
            'general-delete',

            'admin-view',
            'admin-create',
            'admin-update',
            'admin-delete',

            'profile-view',
            'profile-create',
            'profile-update',
            'profile-delete',

            // 'notification-view',
            // 'notification-create',
            // 'notification-update',
            // 'notification-delete',

            'setting-view',
            'setting-create',
            'setting-update',
            'setting-delete',
        ];

        foreach ($permissions as $permission) {
            PermissionModel::create(['name' => $permission]);
        }

        # Create roles
        $roleSuperadministrator = PermissionRole::create(['name' => 'super_administrator']);

        $roleAdministrator = PermissionRole::create(['name' => 'administrator']);
        $roleAdministrator->syncPermissions([
            'dashboard-view',

            'division-view',
            'division-create',
            'division-update',
            'division-delete',

            'position-view',
            'position-create',
            'position-update',
            'position-delete',

            'blog-view',
            'blog-create',
            'blog-update',
            'blog-delete',

            'research-view',
            'research-create',
            'research-update',
            'research-delete',

            'thread-view',
            'thread-create',
            'thread-update',
            'thread-delete',

            'comment-view',
            'comment-create',
            'comment-update',
            'comment-delete',

            'event-view',
            'event-create',
            'event-update',
            'event-delete',

            'participant-view',
            'participant-create',
            'participant-update',
            'participant-delete',

            'recruitment-view',
            'recruitment-create',
            'recruitment-update',
            'recruitment-delete',

            'member-view',
            'member-create',
            'member-update',

            'general-view',
            'general-create',
            'general-update',
            'general-delete',

            'profile-view',
            'profile-create',
            'profile-update',
            'profile-delete',

            // 'notification-view',
            // 'notification-create',
            // 'notification-update',
            // 'notification-delete',

            'setting-view',
            'setting-create',
            'setting-update',
            'setting-delete',
        ]);

        $roleMember = PermissionRole::create(['name' => 'member']);
        $roleMember->syncPermissions([
            'dashboard-view',

            'division-view',

            'position-view',

            'blog-view',
            'blog-create',
            'blog-update',
            'blog-delete',

            'thread-view',
            'thread-create',
            'thread-update',
            'thread-delete',

            'comment-view',
            'comment-create',
            'comment-update',
            'comment-delete',

            'research-view',

            'event-view',

            'participant-view',

            'recruitment-view',

            'member-view',

            'general-view',

            'profile-view',
            'profile-create',
            'profile-update',
            'profile-delete',

        ]);

        $roleGeneral = PermissionRole::create(['name' => 'general']);
        $roleGeneral->syncPermissions([
            'dashboard-view',

            'blog-view',
            'blog-create',
            'blog-update',
            'blog-delete',

            'thread-view',
            'thread-create',
            'thread-update',
            'thread-delete',

            'comment-view',
            'comment-create',
            'comment-update',
            'comment-delete',

            'profile-view',
            'profile-create',
            'profile-update',
            'profile-delete',
        ]);

        # Create users
        $userSuperadministrator = User::factory()->create([
            'name' => 'Super Administrator',
            'gender' => 'L',
            'birthplace' => 'Palu',
            'date_of_birth' => now(),

            'phone_number' => '01234678901',
            'email' => 'superadmin@mail.com',
            'password' => Hash::make('password'),
            'address' => 'Palu',

            'division_id' => null,
            'position_id' => null,
        ]);

        $userAdministrator = User::factory()->create([
            'name' => 'Administrator',
            'gender' => 'L',
            'birthplace' => 'Palu',
            'date_of_birth' => now(),

            'phone_number' => '01234678902',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password'),
            'address' => 'Palu',

            'division_id' => null,
            'position_id' => null,
        ]);

        $userMember = User::factory()->create([
            'name' => 'Member',
            'gender' => 'L',
            'birthplace' => 'Palu',
            'date_of_birth' => now(),

            'phone_number' => '01234678903',
            'email' => 'member@mail.com',
            'password' => Hash::make('password'),
            'address' => 'Palu',

            'division_id' => null,
            'position_id' => null,
        ]);

        $userGeneral = User::factory()->create([
            'name' => 'General',
            'gender' => 'L',
            'birthplace' => 'Palu',
            'date_of_birth' => now(),

            'phone_number' => '01234678904',
            'email' => 'general@mail.com',
            'password' => Hash::make('password'),
            'address' => 'Palu',

            'division_id' => null,
            'position_id' => null
        ]);

        # Assign roles
        $userSuperadministrator->assignRole($roleSuperadministrator);
        $userAdministrator->assignRole($roleAdministrator);
        $userMember->assignRole($roleMember);
        $userGeneral->assignRole($roleGeneral);
    }
}
