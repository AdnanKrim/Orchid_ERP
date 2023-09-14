<?php

namespace App\Models\CRM;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory;

    protected $fillable = [
        'files'
    ];

    public function setFilenamesAttribute($value)
    {
        $this->attributes['files'] = json_encode($value);
    }
}
