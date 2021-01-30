<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $guarded = [];

    public function book(){
    	return $this->belongsTo(
    		Book::class,
    		"book_id",
    		"id"
    	);
    }
    public function books(){
    	return $this->hasMany(
    		Book::class,
    		'author_id',
    		'id'
    	);
    }
}
