<?php

namespace App\Models\FollowUp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class emailHistory extends Model
{
    use HasFactory;
    protected $fillable = ['templateId','subject','body','email'];
}
