<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class ClientController extends Controller
{
    //
    public function getClientDashboard() 
    {
        return view('client.dashboard');
    }

    public function getMyProfile() {
        $user_id = auth()->user()->id;
        $user = User::where('id', $user_id)->first();

        // return response()->json($user);
        return view('client.profile', compact('user'));
    }

    public function updateMyProfile(Request $request) {
        // dd($request->all());

        $request->validate([
            // 'name' => 'required|min:6',
            'name' => 'required',
            'phone' => 'nullable',
        ]);

        // $user_id = auth()->user()->id;
        $user_id = $request->user_id;
        $user = User::where('id', $user_id)->first();
        // dd($user);
                
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        // $user->name = $request->name;
        // $user->phone = $request->phone;
        // $user->save();

        // return redirect()->route('client.profile', compact('user'));
        return view('client.profile', compact('user'));
    }

}
