<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manufacture extends Model
{
    //
	protected $fillable = ['title','alias'];

	public function tablet() {
		return $this->hasMany(Tablet::class);
	}

}
