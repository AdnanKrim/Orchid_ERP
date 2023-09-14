<?php

namespace App\Models\FollowUp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsHistory extends Model
{
    use HasFactory;
    protected $fillable = ['templateId','message','phoneNo'];
}
