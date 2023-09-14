<?php

namespace App\Models\CRM\Measurement;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeasurementCart extends Model
{
    use HasFactory;
    protected $guarded=[];
    protected $casts = [
        'measurementCartInfo' => 'array',
    ];
}
