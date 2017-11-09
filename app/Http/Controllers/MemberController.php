<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;

use Image;

use App\Http\Requests\StoreMembers;
use App\Http\Requests\EditMembers;


class MemberController extends Controller
{
    // Display a list of the members
//    public function index($id = null) 
//    {
//        if ($id == null) {
//            return Member::orderBy('id', 'asc')->get();
//        } else {
//            return $this->show($id);
//        }
//    }
    public function index()
    {
        return Member::orderBy('id', 'ASC')->get();
    }
    
    
    // Stores a newly created resource in storage.
    public function store(StoreMembers $request)
    {
        if($request->hasFile('profile_img')) {
            $image = $request->file('profile_img');
            $filename = $image->getClientOriginalName();
            $location = public_path('images/'.$filename);
            Image::make($image)->save($location);
        }
        
        $member = new Member; // new member obj
        
        $member->name      = $request->name;
        $member->address   = $request->address;
        $member->age = $request->age;
        $member->profile_img = $filename;
        $member->save();
        
        return ' Member record created successfully';
    }
    
    
    // Display the specified resource.
    public function edit($id)
    {
        return Member::find($id);
    }
    
    
    
    // Update the specified resource in storage
    public function update($id, EditMembers $request)
    {
        $member = Member::find($id);
        
        if ($request->hasFile('profile_img'))
        {
            $image = $request->file('profile_img');
            $filename = public_path('images/'.$filename);
            Image::make($image)->save($location);
            $member->profile_img = $filename;
        }
        
        $member->name = $request->name;
        $member->address = $request->address;
        $member->age = $request->age;
        
        $member->save();
        
        return "Member with id successfully update.";
    }
    
    
    
    // remove the specified resource from storage.
    public function destroy($id)
    {
        $member = Member::find('id');
        
        $member->delete();
        
        return "Member record with id #" . $id . " successfully deleted."; 
    }
    
    
}
