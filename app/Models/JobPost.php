<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPost extends Model
{
    use HasFactory;
    protected $fillable = [
        'company_id',
        'title',
        'category_id',
        'position',
        'details',
        'deadline'
    ];

    public function company() {
        return $this->belongsTo('App\Models\Company');
    }

    public function applications() {
        return $this->hasMany('App\Models\Application');
    }

    public function category() {
        return $this->belongsTo('App\Models\Category');
    }

}
