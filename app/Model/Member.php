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

    public function insert($request)
    {
        $member = new Member;
        $member->name = $request->name;
        $member->age = $request->age;
        $member->address = $request->address;
        $member->gender = $request->gender;
        if ($request->photo != 'null') {
            $imageName = time().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('upload/avatar'), $imageName);
        } else {
            $imageName = 'default.png';
        }
        $member->photo = $imageName;
        $member->save();
    }

    public function getDelete($id)
    {
        $member = Member::find($id);
        $member->delete();
    }

    public function getById($id)
    {
        $member = Member::find($id);
        return $member;
    }

    public function updateData($request)
    {
        $member = Member::find($request->id);
        if ($request->name) {
            $member->name = $request->name;
        }
        if ($request->age) {
            $member->age = $request->age;
        }
        if ($request->address) {
            $member->address = $request->address;
        }
        if ($request->gender) {
            $member->gender = $request->gender;
        }
        if ($request->photo != 'null') {
            $imageName = time().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('upload/avatar'), $imageName);
            $member->photo = $imageName;
        }
        $member->save();
    }
}
