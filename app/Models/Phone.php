<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use SoftDeletes;

    protected $fillable = ['supplier_id', 'phone'];

    public function getPhoneAttribute($phone)
    {
        return "(". substr($phone, 0, 2) . ') ' . substr($phone, 2, 9);
    }
  
}   
