<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'title',
        'keywords',
        'description',
        'company',
        'address',
        'phone',
        'fax',
        'email',
        'smtp_server',
        'smtp_port',
        'smtp_email',
        'smtp_password',
        'aboutus',
        'contact',
        'references',
        'status',
    ];
}
