<?php

namespace App\Http\Controllers;

use \App\User;
use Illuminate\Http\Request;

class MembersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        return view('mess.members.index');
    }

    public function create()
    {
        return view('mess.members.create');
    }

    public function store(Request $request,User $member)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $member->fill($request->all());
        $member->mess_id=Auth()->user()->mess_id;
        $member->password=bcrypt($request->password);
        $member->priority=0;
        $member->save();
        if($member){
            success('Member Saved Successfully');
        }else{
            error();
        }

        return redirect()->back();
    }

    public function show(User $member)
    {
        return view('mess.members.show',compact('member'));
    }

    public function edit(User $member)
    {
        return view('mess.members.edit',compact('member'));
    }

    public function update(Request $request, User $member)
    {
        $this->validate($request,[
            'sl' => 'required',
            'message' => 'required',
            'status' => 'required'
        ]);
        $member->fill($request->all())->save();
        if($member){
            success('Member Updated Successfully');
        }else{
            error();
        }

        return redirect()->back();
    }

    public function destroy(User $member)
    {
        $member->delete();
        if($member){
            return response()->json([
                'success' => true
            ]);
        }

        return response()->json([
            'success' => false
        ]);
    }
}
