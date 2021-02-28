<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StepApproval extends Model
{
    protected $fillable = [
        'id','approval_id' ,'step_name','step_number'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User','user__step_approvals');
    }

    public function approval()
    {
        return $this->belongsTo('App\Models\Approval');
    }


}
