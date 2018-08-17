<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tablet extends Model
{
    //
	protected $fillable = ['title','img','alias','description','category_id','manufacture_id'];

	public function user() {
		return $this->belongsTo(User::class);
	}
	public function category() {
		return $this->belongsTo(Category::class);
	}
	public function manufacture() {
		return $this->belongsTo(Manufacture::class);
	}


}
