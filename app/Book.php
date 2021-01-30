<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
	//
    protected $fillable = [
    	'name', 'author_id',
    ];
    public function author(){
    	return $this->belongsTo(
    		\App\Author::class,
    		'author_id',
    		'id'
    	);
    }
}
