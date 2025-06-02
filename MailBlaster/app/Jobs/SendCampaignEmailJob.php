<?php

namespace App\Jobs;

use App\Models\Campaign;
use App\Models\EmailRecipient;
use App\Mail\CampaignMailable;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendCampaignEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $campaign;
    public $recipient;

    /**
     * Create a new job instance.
     */
    public function __construct(Campaign $campaign, EmailRecipient $recipient)
    {
        $this->campaign = $campaign;
        $this->recipient = $recipient;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->recipient->email)->send(new CampaignMailable($this->campaign, $this->recipient));
            $this->recipient->update([
                'status' => 'sent',
                'sent_at' => now(),
                'error_message' => null,
            ]);
            $this->campaign->increment('sent_emails');
        } catch (\Throwable $e) {
            $this->recipient->update([
                'status' => 'failed',
                'error_message' => $e->getMessage(),
            ]);
            $this->campaign->increment('failed_emails');
        }

        // Verificar si ya no quedan destinatarios pendientes y finalizar campaña
        if (
            $this->campaign->recipients()->where('status', 'pending')->count() === 0 &&
            $this->campaign->status !== 'finished'
        ) {
            $this->campaign->status = 'finished';
            $this->campaign->save();
        }
    }
}
