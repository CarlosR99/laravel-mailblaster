<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'template_id',
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

    public function template()
    {
        return $this->belongsTo(\App\Models\Template::class);
    }
}