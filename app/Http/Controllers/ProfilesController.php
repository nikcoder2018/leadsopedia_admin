<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;

use App\Http\Requests\UpdateProfile as UpdateProfileRequest;
use App\Rules\MatchOldPassword;
use App\User;
class ProfilesController extends Controller
{
    public function index(){
        return view('contents.profile');
    }

    public function changeAvatar(Request $request){
        $user = User::find(auth()->user()->id);
        if($request->hasFile('image')){
            if($request->file('image')->isValid()){
                // Get image file
                $image = $request->file('image');

                // Make a image name based on user name and current timestamp
                $name = Str::slug($user->name).'_'.time();

                $extension = $request->image->extension();

                $request->image->storeAs('/public/profiles/avatars', $name.".".$extension);
                $url = Storage::url('profiles/avatars/'.$name.".".$extension);

                $user->avatar = $url;
            }
        }
        $user->save();

        return response()->json(array('success'=> true, 'msg' => 'New avatar successfully saved.'));
    }
    public function changeCover(Request $request){
        $user = User::find(auth()->user()->id);
        if($request->hasFile('image')){
            if($request->file('image')->isValid()){
                // Get image file
                $image = $request->file('image');

                // Make a image name based on user name and current timestamp
                $name = Str::slug($user->name).'_'.time();

                $extension = $request->image->extension();

                $request->image->storeAs('/public/profiles/covers', $name.".".$extension);
                $url = Storage::url('profiles/covers/'.$name.".".$extension);

                $user->cover = $url;
            }
        }
        $user->save();

        return response()->json(array('success'=> true, 'msg' => 'New cover successfully saved.'));
    }
    public function changePassword(Request $request){
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);

        return response()->json(array('success' => true,'msg' => 'Password successfully changed.'));
    }
    public function updateProfile(UpdateProfileRequest $request){
        $validated = $request->validated();
        User::find(auth()->user()->id)->update(['name'=> $validated['name'],'email' => $validated['email']]);
        
        return response()->json(array('success' => true,'msg' => 'Profile successfully updated.'));
    }
}
