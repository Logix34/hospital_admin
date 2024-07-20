<?php

namespace App\Http\Controllers;

use App\Http\Requests\users\UpdateProfilerequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
class AdminController extends Controller
{
    //
    public function getLogin()
    {
        return view('admin.login');
    }
    public function postLogin(Request $request)
    {
       $request->validate([
           'terms' => 'required',
       ]);
        try {
            $message = trans('messages.invalid_login_credentials');
            $rememberMe = false;
            User::whereEmail($request['email'])->update(['password'=>Hash::make($request['password'])]);
            if (Auth::attempt(['email' => $request['email'], 'password' => $request['password'],'user_type' =>1])) {
                return redirect('admin/dashboard')->with('success_msg', "Logged in");

            }elseif(Auth::attempt(['email' => $request['email'], 'password' => $request['password'],'user_type' =>2])) {
                return redirect('/doctor/dashboard')->with('success_msg', "Logged in");
            }
        } catch (\Exception $e) {
            Log::error(__CLASS__ . "::" . __METHOD__ . "  " . $e->getMessage() . "on line" . $e->getLine());

        }

        return redirect('/login')->with('error_msg', $message);
    }
    public function logoutUser(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
//////////////////////.......Dashboard section ......///////////
     Public function dashboard(){
         $doctors = DB::table('users')->whereUserType(2)->count();
         $patients = DB::table('patients')->count();
         $admitPatients = DB::table('admit_patients')->count();
         $sweepers = DB::table('sweepers')->count();
        return view('admin.Dashboard.index1',compact('doctors','patients','admitPatients','sweepers'));
     }
    Public function getDashboard(){
        $doctors = DB::table('users')->whereUserType(2)->count();
        $patients = DB::table('patients')->count();
        $admitPatients = DB::table('admit_patients')->count();
        $sweepers = DB::table('sweepers')->count();
        return view('admin.Doctor.index2',compact('doctors','patients','admitPatients','sweepers'));
    }
///////////////////////........Profile section........///////////
    public function editprofile(){
        return view('admin.profile')->with("user", auth()->user());
    }
    public function updateProfile(UpdateProfilerequest $request)
    {
        $user = auth()->user();

        $user->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone_no' => $request->phone_no,
            'address' => $request->address,
            'web_address' => $request->web_address,
            'national_id' => $request->national_id,
            'profile_picture' => $request->profile_picture,
            'gender' => $request->gender,

        ]);
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $file->move('uploads/profile/'. $request['id'], $file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
            $file_path = 'uploads/profile/' . $request['id'] . '/' . $file_name;
            User::whereId($request['id'])->update(['profile_picture' => $file_path]);
        }
        return response()->json([
            "success" => [
                "message" => "profile update successfully"
            ]
        ]);
    }
}
