<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Member;

class MembersController extends Controller
{
	protected $member;

	public function __construct(Member $member){
		$this->member = $member;
	}

    public function index()
    {
    	return view('dashboard.index');
    }

    public function getList()
    {
    	$data = $this->member->getList();
    	return response()->json($data);
    }
}
