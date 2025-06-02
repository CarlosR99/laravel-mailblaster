<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\EmailRecipient;
use App\Models\Campaign;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EmailRecipientTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function pertenece_a_campana()
    {
        $campaign = Campaign::factory()->create();
        $recipient = EmailRecipient::factory()->create(['campaign_id' => $campaign->id]);

        $this->assertInstanceOf(Campaign::class, $recipient->campaign);
    }

    /** @test */
    public function puede_marcarse_como_enviado_y_fallido()
    {
        $recipient = EmailRecipient::factory()->create(['status' => 'pending']);
        $recipient->status = 'sent';
        $recipient->save();

        $this->assertEquals('sent', $recipient->fresh()->status);

        $recipient->status = 'failed';
        $recipient->save();

        $this->assertEquals('failed', $recipient->fresh()->status);
    }

    /** @test */
    public function guarda_error_message_correctamente()
    {
        $recipient = EmailRecipient::factory()->create(['error_message' => null]);
        $recipient->error_message = 'SMTP error';
        $recipient->save();

        $this->assertEquals('SMTP error', $recipient->fresh()->error_message);
    }
}
