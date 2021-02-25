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
        'user_id',
        'approval_id',
    ];

    /**
     * Attributes to include in the Audit.
     *
     * @var array
     */
    protected $auditInclude = [
        'title',
        'content',
    ];

    protected static function booted()
    {
        self::observe(PrRequestObserver::class);
    }

    public function requestitems(){
        return $this->hasMany('App\Models\RequestItem');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function mainGroup()
    {
        return $this->belongsTo('App\Models\MainGroup');
    }

    public function approval()
    {
        return $this->belongsTo('App\Models\Approval', 'approval_id');
    }
}
