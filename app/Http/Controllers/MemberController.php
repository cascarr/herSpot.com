<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member;

use Illuminate\Http\UploadedFile;
use Image;

use App\Http\Requests\StoreMembers;
use App\Http\Requests\EditMembers;

class MemberController extends Controller
{

    public function index()
    {
        return Member::orderBy('id', 'ASC')->get();
    }
    
    
    // Stores a newly created resource in storage.
    public function store(Request $request)
    {
        $request = $this->uploadFile($request, 'img');
        (new Member())->fill($request->except('img'))->save();
        
        return ' Member record created successfully';
    }
    
    
    // Display the specified resource.
    public function edit($id)
    {
        $member = Member::find($id);
        return $member;
    }
    
    private function uploadFile(Request $request, $file){
        if ($request->hasFile($file))
        {
            $image = $request->file($file);
            $filename = $image->getClientOriginalName();
            $location = public_path('images/'.$filename);
            Image::make($image)->save($location);
            $request->merge(['profile_img' => $filename]);
        }
        return $request;
    }
    
    // Update the specified resource in storage
    public function update($id, Request $request)
    {
        $member = Member::find($id);

        if(!$member){
            return 'Member not found';
        }

        $request = $this->uploadFile($request, 'img');

        $member->fill($request->except('img'))->save();
        
        return "Member with id successfully update.";
    }

    // remove the specified resource from storage.
    public function destroy($id)
    {
        Member::find($id)->delete();

        return "Member record with id #" . $id . " successfully deleted."; 
    }
    
    
}
