<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\SystemLog;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SystemLogTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function se_crea_correctamente_al_registrar_accion()
    {
        $user = User::factory()->create();
        $log = SystemLog::create([
            'user_id' => $user->id,
            'action' => 'login',
            'description' => 'Inicio de sesión'
        ]);

        $this->assertDatabaseHas('system_logs', [
            'user_id' => $user->id,
            'action' => 'login',
            'description' => 'Inicio de sesión'
        ]);
    }

    /** @test */
    public function relacion_con_usuario_funciona()
    {
        $user = User::factory()->create();
        $log = SystemLog::create([
            'user_id' => $user->id,
            'action' => 'logout',
            'description' => 'Cierre de sesión'
        ]);

        $this->assertInstanceOf(User::class, $log->user);
    }
}
