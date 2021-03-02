<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $table = 'comments';

    protected $fillable = [
        'user_id',
        'pr_request_id',
        'comment_text',
        'created_at',
        'updated_at',
    ];

    // protected function serializeDate(DateTimeInterface $date)
    // {
    //     return $date->format('Y-m-d H:i:s');
    // }

    public function prrequest(){
        return $this->belongsTo('App\Models\PrRequest');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
