<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_tener_roles()
    {
        $user = User::factory()->create();
        $role = Role::create(['name' => 'admin']);
        $user->assignRole('admin');

        $this->assertTrue($user->hasRole('admin'));
    }

    /** @test */
    public function puede_activarse_y_desactivarse()
    {
        $user = User::factory()->create(['active' => false]);
        $user->active = true;
        $user->save();

        $this->assertTrue($user->fresh()->active);

        $user->active = false;
        $user->save();

        $this->assertFalse($user->fresh()->active);
    }

    /** @test */
    public function relacion_con_campanas_funciona()
    {
        $user = User::factory()->create();
        $campaign = $user->campaigns()->create([
            'name' => 'Campaña Test',
            'status' => 'draft'
        ]);

        $this->assertTrue($user->campaigns->contains($campaign));
    }

    /** @test */
    public function relacion_con_logs_funciona()
    {
        $user = User::factory()->create();
        $log = $user->logs()->create([
            'action' => 'login',
            'description' => 'Inicio de sesión'
        ]);

        $this->assertTrue($user->logs->contains($log));
    }
}
