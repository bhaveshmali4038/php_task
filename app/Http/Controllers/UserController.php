<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return view('index');
    }

    public function create(Request $request)
    {
        return view('edit');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $hobbies = explode(",",$user->hobbies);
        return view('edit', compact('user','hobbies'));
    }

    public function userAjax(Request $request)
    {
        $user = User::OrderByDesc('id')->get();
        $table = DataTables::of($user)
            ->editColumn('id', function ($user) {
                return $user->id;
            })
            ->editColumn('name', function ($user) {
                return $user->name;
            })
            ->editColumn('email', function ($user) {
                return $user->email;
            })
            ->editColumn('role', function ($user) {

                if($user->role == "1"){
                    return "Sales Executive";
                }else if($user->role == "2"){
                    return "CRM";
                }else if($user->role == "3"){
                    return "HR";
                }else if($user->role == "4"){
                    return "SEO";
                }else if($user->role == "5"){
                    return "BDE";
                }else{
                    return "-";
                }
            })
            ->editColumn('image', function ($user) {
                $imageurl = asset($user->profile_pic);
                $html = '<div style="width: 100px;
                        height: 100px;
                        background-position: center;
                        background-size: cover;
                        background-repeat: no-repeat;
                        background-image: url(' . $imageurl . ');"></div>';
                return $html;
            })
            ->editColumn('status', function ($user) {
                if($user->status == "1"){
                    $html = '<button type="button" class="btn btn-success customSwitch1" data="0" id="'.$user->id.'">Active</button>';
                    return $html;
                }else{
                    $html = '<button type="button" class="btn btn-danger customSwitch1" data="1" id="'.$user->id.'">Inactive</button>';
                    return $html;
                }
            })
            ->editColumn('action', function ($user) {
                $edit_route = route('user.edit', $user->id);
                $delete_route = route('user.destroy', $user->id);
                $html = '<a href="' . $edit_route . '" class="" data-href="' . $edit_route . '"><i class="fa fa-edit "></i></a>
                         <a href="javascript:void(0)" class="deleteuser" data-href="' . $delete_route . '">
                         <i class="fa fa-trash"></i></a>';
                return $html;
            })
            ->rawColumns(['image', 'status', 'action'])
            ->make(true);
        return $table;
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users',
            'profile' => 'required|mimes:png,jpg,jpeg',
            'document' => 'required|mimes:doc,pdf',
        ]);

        if ($validator->fails()) {          
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $profile_image = "";
        $document = "";

        if ($request->hasFile('profile')) {
            $filePath = public_path('uploads/image');
            if (!\Illuminate\Support\Facades\File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 0777, true, true);
            }
            $time = Str::uuid();
            $extension = pathinfo($request->profile->getClientOriginalName(), PATHINFO_EXTENSION);
            $file_name = $time . '.' . $extension;
            $filePath = public_path('uploads/image');
            $request->profile->move($filePath, $file_name);
            $profile_image = asset('uploads/image') . '/' . $file_name;
        }

        if ($request->hasFile('document')) {
            $filePath = public_path('uploads/image');
            if (!\Illuminate\Support\Facades\File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 0777, true, true);
            }
            $time = Str::uuid();
            $extension = pathinfo($request->document->getClientOriginalName(), PATHINFO_EXTENSION);
            $file_name = $time . '.' . $extension;
            $filePath = public_path('uploads/image');
            $request->document->move($filePath, $file_name);
            $document = asset('uploads/image') . '/' . $file_name;
        }

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->gender = $request->gender ?? "";
        $user->hobbies = implode(',', $request->hobbies);
        $user->profile_pic = $profile_image;
        $user->file = $document;
        $user->save();
        return redirect()->route('user.index')->with('success', 'User Added successfully ');
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'profile' => 'mimes:png,jpg,jpeg',
            'document' => 'mimes:doc,pdf',
        ]);

        if ($validator->fails()) {          
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user = User::where('id', $id)->first();

        $profile_image = "";
        $document = "";

        if ($request->hasFile('profile')) {
            $filePath = public_path('uploads/image');
            if (!\Illuminate\Support\Facades\File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 0777, true, true);
            }
            $time = Str::uuid();
            $extension = pathinfo($request->profile->getClientOriginalName(), PATHINFO_EXTENSION);
            $file_name = $time . '.' . $extension;
            $filePath = public_path('uploads/image');
            $request->profile->move($filePath, $file_name);
            $profile_image = asset('uploads/image') . '/' . $file_name;
        }

        if ($request->hasFile('document')) {
            $filePath = public_path('uploads/image');
            if (!\Illuminate\Support\Facades\File::isDirectory($filePath)) {
                File::makeDirectory($filePath, 0777, true, true);
            }
            $time = Str::uuid();
            $extension = pathinfo($request->document->getClientOriginalName(), PATHINFO_EXTENSION);
            $file_name = $time . '.' . $extension;
            $filePath = public_path('uploads/image');
            $request->document->move($filePath, $file_name);
            $document = asset('uploads/image') . '/' . $file_name;
        }

        if($request->profile != ""){
            $user->profile_pic = $profile_image;
        } 
        if($request->document != ""){
            $user->file = $document;
        } 
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->gender = isset($request->gender) ? $request->gender : "";
        $user->hobbies = isset($request->hobbies) ? implode(',', $request->hobbies) : "";
        $user->update();
        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

    public function statusAjax(Request $request)
    {
        User::where('id', $request->id)
            ->update(['status' => $request->status]);   
    }

    public function destroy(Request $request, $id)
    {
        User::find($id)->delete();
        return response()->json(['message' => "User deleted successfully."]);
    }
}
