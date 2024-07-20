<?php

namespace App\Http\Controllers;

use App\Http\Requests\users\UpdateProfilerequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {
      return view('admin.Users.index');

    }
    public function getAdd()
    {
        return view('admin.Users.add');

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function createDoctor(Request $request)
    {
        {
            \DB::beginTransaction();
            $Doctor_data = [
                'title' => $request['title'],
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'profile_picture'=>$request['profile_picture'],
                'national_id' =>$request['national_id'],
                'password' => Hash::make($request ['password']),
                'phone_no' =>$request ['phone_no'],
                'web_address'=> $request['web_address'],
                'address' => $request['address'],
                'gender' => $request['gender'],
                'is_delete' =>0,
                'user_type' =>2,
            ];
                if(User::whereId($request['id'])->count()){
                    User::whereId($request['id'])->update($Doctor_data);
                }else{
                    $Doctordata = User::create($Doctor_data);
                }

        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $file->move('uploads/profile/'. $request['id'], $file->getClientOriginalName());
            $file_name = $file->getClientOriginalName();
            $file_path = 'uploads/profile/' . $request['id'] . '/' . $file_name;
            User::whereId($request['id'])->update(['profile_picture' => $file_path]);
        }
            DB::commit();
        };
        return response()->json([
            "success" => [
                "message" => "Doctor Add Successfully"
            ]
        ]);
    }
        public function getUserListing()
            {
                $doctors=User::whereUserType(2);
                return DataTables::of($doctors)
                    ->addColumn('name',function ($names){
                        return $names->first_name.' ' .$names->last_name;
                    })
                    ->addColumn('action',function ($doctors) {
                              $button = '';
                              if(gate::allows('can-update')){
                                  $button .= ' <a class="btn btn-warning btn-sm" href="' . url("users/edit/" . $doctors->id) . '"><i class="fas fa-user-edit"></i></a>';
                                  $button .= ' <button class="btn btn-danger delete btn-sm" onclick="delete_btn(' . $doctors->id . ')"><i class="fas fa-user-minus"></i></a>';
                              }
                              return $button;
                    })->addColumn('status',function ($doctors){
                        return $doctors->status===1?"Disabled":"Enabled";
                    })->rawColumns(['action'])->make(true);
            }
    /*
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }
    /*
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $detail= User::whereId($id)->first();
        return view('admin.Users.add',['header'=>"Edit Doctor",'detail'=>$detail]);
    }
    /*
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }
    /*
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
