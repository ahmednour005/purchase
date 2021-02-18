<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_StepApproval extends Model
{
    protected $fillable = [
        'id','user_id' ,'step_approval_id'
    ];
}
