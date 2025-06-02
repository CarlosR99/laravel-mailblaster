<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Database\Seeders\RolePermissionSeeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeederTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function crea_roles_y_permisos_correctamente()
    {
        $this->seed(RolePermissionSeeder::class);

        $this->assertGreaterThan(0, Role::count());
        $this->assertGreaterThan(0, Permission::count());
    }
}
