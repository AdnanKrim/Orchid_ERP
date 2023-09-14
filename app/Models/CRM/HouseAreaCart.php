<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseAreaCart extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $casts = [
        'houseAreaCartInfo' => 'array',
    ];
}
