<?php

namespace Database\Seeders;

use App\Domain\Users\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'admin.access',
            'pages.manage',
            'news.manage',
            'partners.manage',
            'services.manage',
            'leads.manage',
            'consultations.manage',
            'courses.manage',
            'orders.manage',
            'payments.view',
            'users.manage',
            'roles.manage',
            'seo.manage',
            'settings.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::findOrCreate($permission, 'web');
        }

        $roles = [
            'super_admin' => $permissions,
            'admin' => array_diff($permissions, ['roles.manage']),
            'content_manager' => ['admin.access', 'pages.manage', 'news.manage', 'partners.manage', 'services.manage', 'seo.manage'],
            'sales_manager' => ['admin.access', 'leads.manage', 'consultations.manage', 'orders.manage', 'payments.view'],
            'teacher' => ['admin.access', 'courses.manage'],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::findOrCreate($roleName, 'web');
            $role->syncPermissions($rolePermissions);
        }

        $superAdmin = User::firstOrCreate(
            ['email' => env('SEED_ADMIN_EMAIL', 'admin@example.ru')],
            [
                'name' => env('SEED_ADMIN_NAME', 'Администратор'),
                'password' => Hash::make(env('SEED_ADMIN_PASSWORD', 'password')),
                'is_active' => true,
                'email_verified_at' => now(),
            ],
        );

        $superAdmin->assignRole('super_admin');
    }
}
