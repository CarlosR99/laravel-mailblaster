<?php

namespace App\Mail;

use App\Models\Campaign;
use App\Models\EmailRecipient;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CampaignMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $campaign;
    public $recipient;

    /**
     * Create a new message instance.
     */
    public function __construct(Campaign $campaign, EmailRecipient $recipient)
    {
        $this->campaign = $campaign;
        $this->recipient = $recipient;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        if ($this->campaign->template_id) {
            $template = \App\Models\Template::find($this->campaign->template_id);
            return $this->subject($template->subject ?: 'Campaña publicitaria')
                ->html($template->content);
        } elseif ($this->campaign->image_path) {
            return $this->subject('Campaña publicitaria')
                ->view('emails.templates.imagen')
                ->with(['campaign' => $this->campaign]);
        } else {
            // Si no hay plantilla ni imagen, lanza excepción o retorna error
            throw new \Exception('La campaña no tiene plantilla ni imagen asociada.');
        }
    }
}
