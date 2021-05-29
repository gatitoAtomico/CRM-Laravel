<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class UsersProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::find(Auth::id());
        return view('profile', ['avatar' => $user->avatar, 'user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        // check if image has been received from request
        if ($request->file('avatar')) {

            // validate request data
            $request->validate([
                'avatar' => ['image', 'dimensions:max_width=1000,max_height=1000'],
            ]);

            $user = User::find(Auth::id());

            // check if user has an existing avatar
            if ($user->avatar != "default.jpg") {

                Storage::disk('user_avatars')->delete($user->avatar);
            }

            $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $shuffled = str_shuffle($str);
            // processing the uploaded image
            $avatar_name = $shuffled . '.' . $request->file('avatar')->getClientOriginalExtension();
            $avatar_path = $request->file('avatar')->storeAs('', $avatar_name, 'user_avatars');
            $user->avatar = $avatar_path;

            // update User Avatar
            if ($user->save()) {
                return view('profile', ['avatar' => $avatar_path, 'user' => $user])->with('message', 'Avatar Successfully Updated');

            } else {
                Session::flash('error', "Something Went Wrong");
                return Redirect::back();
            }

        }

        Session::flash('error', "No image file uploaded!");
        return Redirect::back();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z]+$/u',
            'email' => 'required|email',
            'lastName' => 'required|regex:/^[a-zA-Z]+$/u'
        ]);

        $user = User::find($id);
        $user->first_name = $request->name;
        $user->last_name = $request->lastName;
        $user->email = $request->email;
        $save = $user->save();

        if (!$save) {
            return response([
                'message' => 'Something Went Wrong please try again',
            ]);
        }

        return response([
            'message' => 'User profile has been updated',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
