<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index(){
        return view('profile.index', [
            'profile'   => Auth::user()
        ]);
    }

    public function update(Request $request){
        $user = Auth::user();

        $request->validate([
            'name'          => 'required',
            'reg_number'    => 'required|unique:guests,reg_number,'.$user->guest->id,
            'email'         => 'required|email|unique:users,email,'.$user->id,
            'class'         => 'max:1'
        ]);


        if(!empty($request->profile_picture)) {
            request()->validate([
                'profile_picture' => 'required|mimes:png,jpg,jpeg|max:1024',
            ]);

            Storage::delete("public/assets/img/avatars/" . $user->guest->profile_picture);

            $imageName = time().'.'.$request->profile_picture->extension();

            $request->profile_picture->storeAs("/assets/img/avatars/", $imageName, 'public');

            $user->guest->profile_picture = $imageName;
        }

        $user->email = $request->email;
        $user->guest->name = $request->name;
        $user->guest->reg_number = $request->reg_number;
        $user->guest->birth_date = $request->birth_date;
        $user->guest->birth_place = $request->birth_place;
        $user->guest->address = $request->address;
        $user->guest->major = $request->major;
        $user->guest->study_program = $request->study_program;
        $user->guest->class = $request->class;
        
        $user->save();
        $user->guest->save();

        return back()->with('success', 'Berhasil menyimpan perubahan!');
    }
}
