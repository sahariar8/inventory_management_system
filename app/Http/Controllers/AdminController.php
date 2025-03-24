<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{


    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = array(
            'message' => 'Successfully Logout',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    }

    public function profile()
    {
        $id = Auth::id();
        $user = User::find($id);
        return view('backend.admin_profile', compact('user'));
        
    }
    
    public function editProfile()
    {
        $user = User::find(Auth::id());
        return view('backend.admin_profile_edit',compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->email = $request->email;

        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = date('YmdHi').'-'.$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $user->image = $filename;
        }
        $user->save();
        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('profile')->with($notification);
       
    }

    public function changePassword()
    {
        return view('backend.change_password');
    }

    public function updatePassword(Request $request){
        $user = User::find(Auth::id());
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        $hashedPassword = $user->password;
        if(Hash::check($request->oldpassword, $hashedPassword)){
            if(!Hash::check($request->password, $hashedPassword)){
                $user->password = Hash::make($request->password);
                $user->save();
                // Auth::logout();
                $notification = array(
                    'message' => 'Password Changed Successfully',
                    'alert-type' => 'success'
                );
                // return redirect()->route('login')->with($notification);
                return redirect()->back()->with($notification);
            }else{
                $notification = array(
                    'message' => 'New Password can not be the old password',
                    'alert-type' => 'error'
                );
                return redirect()->back()->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'Old Password not matched',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

}