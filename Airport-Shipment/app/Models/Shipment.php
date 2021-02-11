<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    // One Shipment belongs to only one User
    public function user() 
    {
        return $this->belongsTo(User::class);
    }

}
