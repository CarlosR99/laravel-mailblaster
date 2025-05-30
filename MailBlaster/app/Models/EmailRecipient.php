<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailRecipient extends Model
{
    use HasFactory;

    protected $fillable = [
        'campaign_id',
        'email',
        'status',
        'error_message',
        'sent_at',
    ];

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}