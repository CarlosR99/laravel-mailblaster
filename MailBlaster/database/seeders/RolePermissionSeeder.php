<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'campaign.create',
            'campaign.view',
            'campaign.edit',
            'campaign.delete',
            'campaign.send',
            'campaign.report',
            'recipient.upload',
            'recipient.view',
            'template.select',
            'template.upload_image',
            'user.manage',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        $admin = Role::firstOrCreate(['name' => 'administrador']);
        $publicista = Role::firstOrCreate(['name' => 'publicista']);

        $admin->givePermissionTo($permissions);

        $publicista->givePermissionTo([
            'campaign.create',
            'campaign.view',
            'campaign.edit',
            'campaign.send',
            'campaign.report',
            'recipient.upload',
            'recipient.view',
            'template.select',
            'template.upload_image',
        ]);
    }
}
