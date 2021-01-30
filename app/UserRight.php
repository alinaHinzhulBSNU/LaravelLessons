<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRight extends Model
{
	protected $fillable = [
    	'model', 'right', 'user_id',
    ];

    public function userRight(){
        return $this->belongsTo(
            \App\UserRight::class,
            'model',
            'right',
            'user_id',
        );
    }
    
    public function user(){
    	return $this->belongsTo(
    		\App\User::class,
    		'user_id',
    		'id'
    	);
    }
}
