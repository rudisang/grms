<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'physical_address',
        'postal_address',
        'email',
        'phone',
        'cover',
        'logo',
        'verified',
        'bio'
    ];
   

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function jobposts() {
        return $this->hasMany('App\Models\JobPost');
    }

    public function status() {
        return $this->belongsTo('App\Models\Status');
    }
}
