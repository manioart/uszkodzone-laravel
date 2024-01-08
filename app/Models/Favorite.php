<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorite extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'auction_id',
        'user_id',
    ];

    public function auction() 
    {
        return $this->hasOne(Auction::class);
    }
    
    public function user() 
    {
        return $this->belongsTo(User::class);
    
    }
}
