<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Ad;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class City extends Model
{
    use HasFactory;
    protected $fillable=[
        'city',
        'province_id',
        
    ];

    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    public function users()
    {
        return $this->hasMany(User::class);
    }
    public function Ads()
    {
        return  $this->hasMany(Ad::class);
    }
}
