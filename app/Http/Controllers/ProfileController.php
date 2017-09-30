<?php

namespace App\Http\Controllers;

use File;
use Auth;
use Storage;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        return view('profile.index')
            ->withUser(Auth::user());
    }

    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:120'
        ]);

        $user = Auth::user();
        $user->name = $request->name;
        $user->save();
        $file = $request->file('image');
        $filename = $request->name . '-' . $user->id . '.jpg';
//        dd($filename, $file);
        if ($file) {
             Storage::disk('local')->put($filename, File::get($file));
        }
        return redirect()->route('profile.index');
    }

    public function getUserImage($filename)
    {
        $file = Storage::disk('local')->get($filename);
        return response($file, 200);
    }
}
