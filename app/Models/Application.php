<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'job_post_id',
        'cover',
        'status'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function job_post() {
        return $this->belongsTo('App\Models\JobPost');
    }
}
