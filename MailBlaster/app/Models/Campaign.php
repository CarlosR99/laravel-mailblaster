<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'template',
        'image_path',
        'status',
        'total_emails',
        'sent_emails',
        'failed_emails',
    ];

    public function recipients()
    {
        return $this->hasMany(EmailRecipient::class);
    }
}