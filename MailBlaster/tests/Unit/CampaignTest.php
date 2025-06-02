<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Campaign;
use App\Models\User;
use App\Models\Template;
use App\Models\EmailRecipient;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CampaignTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pertenece_a_usuario_y_plantilla()
    {
        $user = User::factory()->create();
        $template = Template::factory()->create();
        $campaign = Campaign::factory()->create([
            'user_id' => $user->id,
            'template_id' => $template->id,
        ]);

        $this->assertInstanceOf(User::class, $campaign->user);
        $this->assertInstanceOf(Template::class, $campaign->template);
    }

    /** @test */
    public function puede_finalizarse_correctamente()
    {
        $campaign = Campaign::factory()->create(['status' => 'sending']);
        $campaign->status = 'finished';
        $campaign->save();

        $this->assertEquals('finished', $campaign->fresh()->status);
    }

    /** @test */
    public function relacion_con_destinatarios_funciona()
    {
        $campaign = Campaign::factory()->create();
        $recipient = EmailRecipient::factory()->create(['campaign_id' => $campaign->id]);

        $this->assertTrue($campaign->recipients->contains($recipient));
    }

    /** @test */
    public function contadores_de_enviados_y_fallidos_se_actualizan()
    {
        $campaign = Campaign::factory()->create();
        EmailRecipient::factory()->count(2)->create(['campaign_id' => $campaign->id, 'status' => 'sent']);
        EmailRecipient::factory()->count(1)->create(['campaign_id' => $campaign->id, 'status' => 'failed']);

        $this->assertEquals(2, $campaign->recipients()->where('status', 'sent')->count());
        $this->assertEquals(1, $campaign->recipients()->where('status', 'failed')->count());
    }
}
