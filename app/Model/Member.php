<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = [
    	'name', 'address', 'age', 'gender', 'photo'
    ];

    public function getList()
    {
    	$members = Member::orderBy('id', 'DESC')->get();
    	return $members;
    }
}
