<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //
	protected $fillable = ['title','parent_id','alias'];

	public function tablet() {
		return $this->hasMany(Tablet::class);
	}


}
