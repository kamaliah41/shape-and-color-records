<?php
//for login authentication, input validation
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request) {
        //to find user in database
        $user = DB::table('users')->where('username', $request->username)->first();

        //if the username entered dont exist
        if (!$user) {
            return back()->with('error', 'Username dont exist');
        }

        //if admin/user is wrongly chosen
        if ($user->role !== $request->role) {
            return back()->with('error', 'No ' . $request->role . ' with username ' . $request->username);
        }

        //check password 
        if ($request->password !== $user->password) {
            return back()->with('error', 'Wrong password');
        }

        //session store
        session([
        'name' => $user->name,
        'username' => $user->username,
        'role' => $user->role
         ]);

        //redirect user according to the role
        return ($user->role == 'admin')
        ? redirect('/admin') : redirect('/user');
    }

    public function logout(Request $request) {
    $request->session()->flush();

    return redirect('/'); }
}
