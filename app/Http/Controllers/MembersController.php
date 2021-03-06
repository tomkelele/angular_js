<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Member;
use App\Http\Requests\MemBerFormRequest;

class MembersController extends Controller
{
    private $member;

    public function __construct(Member $member)
    {
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

    public function insert(MemBerFormRequest $request)
    {
        $this->member->insert($request);
        $data = $this->member->getList();
        return response()->json($data);
    }

    public function getDelete(Request $request)
    {
        $this->member->deleteData($request->id);
        $data = $this->member->getList();
        return response()->json($data);
    }

    public function getDetail(Request $request)
    {
        $data = $this->member->getById($request->id);
        return response()->json($data);
    }

    public function getUpdate(MemBerFormRequest $request)
    {
        $this->member->updateData($request);
        $data = $this->member->getList();
        return response()->json($data);
    }
}
