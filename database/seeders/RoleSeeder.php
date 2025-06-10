<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Exception;
use Illuminate\Support\Facades\Log;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            // Reset cached roles and permissions
            app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

            // Create roles
            $this->command->info('Generating permissions...');
            \Artisan::call('shield:generate', ['--all' => 'admin']);
            $this->command->info('Permissions generated successfully.');

            $superAdminRole = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
            $permissions = Permission::all();
            $superAdminRole->syncPermissions($permissions);

            // Create initial Super Admin user if doesn't exist
            $superAdmin = User::firstOrCreate(
                ['email' => 'fivecar@pkk5.com'],
                [
                    'name' => 'FiveCar',
                    'password' => Hash::make('fivecar5'),
                    'email_verified_at' => now(),
                ]
            );

            // Assign role to user
            $superAdmin->assignRole($superAdminRole);

            $this->command->info('Roles and permissions seeded successfully!');
        } catch (Exception $e) {
            $this->command->error('Error seeding roles and permissions: ' . $e->getMessage());
            Log::error('Role Seeder Error: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }
}
