<?php

namespace App\Models;

use App\Observers\PrRequestObserver;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;


class PrRequest extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'date',
        'request_number',
        'department',
        'project',
        'site',
        'main_group_id',
        'user_location',
        'created_by_id',
        'userstepapproved_id',
        'approval_id',
        'stepapproval_id',
        'userstep_ids',
        'approval_name',
        'steprevert_id',
    ];

    /**
     * Attributes to include in the Audit.
     *
     * @var array
     */
    protected $auditInclude = [
        'date',
        'request_number',
        'department',
        'project',
        'site',
        'main_group_id',
        'user_location',
        'created_by_id',
        'userstepapproved_id',
        'approval_id',
        'stepapproval_id',
        'userstep_ids',
        'approval_name',
        'steprevert_id',
    ];

    protected $casts = [
        'userstep_ids' => 'array'
    ];

    protected static function booted()
    {
        self::observe(PrRequestObserver::class);
    }

    public function requestitems(){
        return $this->hasMany('App\Models\RequestItem');
    }

    public function user(){
        return $this->belongsTo('App\User', 'created_by_id');
    }

    public function mainGroup()
    {
        return $this->belongsTo('App\Models\MainGroup');
    }

    public function approval()
    {
        return $this->belongsTo('App\Models\Approval', 'approval_id');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
