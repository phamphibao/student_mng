<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStore;
use App\Http\Requests\UserUpdateRequest;
use App\Model\Classes;
use App\Model\Roles;
use App\Model\User;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Auth;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            $users = User::where('id', '!=', 1)->paginate(10);
            return view('admin.users.index', compact('users'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Gate::allows('isAdmin')) {
            $classes = Classes::all();
            $roles = Roles::all();
            return view('admin.users.create', compact('roles', 'classes'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStore $request)
    {
        if (Gate::allows('isAdmin')) {
            # code...

            $image = $request->file('image');
            if (!empty($image)) {
                $fileName = time() . $image->getClientOriginalName();
            } else {
                $fileName = null;
            }
            try {
                $user = new User;
                $user->name = $request->name;
                $user->email = $request->email;
                $user->phone = $request->phone;
                if (!empty($request->password)) {
                    $user->password = Hash::make($request->password);
                }
                $user->image = $fileName;
                $user->birth_day = $request->date;
                $user->gender = $request->gender;
                $user->class_id = $request->classes;
                $user->save();
                $user->roles()->attach($request->roles);

                if (!empty($fileName)) {
                    $image->move('upload', $fileName);
                }
            } catch (\Exception $e) {
                abort(404);
            }
            return redirect()->route('user.index')->with('success', 'Th??m th??nh c??ng');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Gate::allows('isAdmin')) {
            $user = User::find($id);
            if (empty($user)) {
                abort('404');
            }
            return view('admin.users.show', compact('user'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user_current = Auth::id();
        if (Gate::allows('isAdmin') || $user_current == $id ) {
            $user_edit = User::find($id);
            $roles = Roles::all();
            $classes = Classes::all();
            $roles_of_user = $user_edit->roles;

            if (empty($user_edit)) {
                abort('404');
            } else {
                return view('admin.users.edit', compact('user_edit', 'roles', 'roles_of_user', 'classes'));
            }
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        if (Gate::allows('isAdmin')) {
            $user_update = User::find($id);
            $old_image = $user_update->image;
            $image = $request->file('image');
            if (!empty($image)) {
                $fileName = time() . $image->getClientOriginalName();
            } else {
                $fileName = null;
            }
            try {

                $user_update->name = $request->name;
                $user_update->email = $request->email;
                $user_update->phone = $request->phone;
                $user_update->birth_day = $request->date;
                $user_update->gender = $request->gender;
                if (!empty($request->password)) {
                    $user_update->password = Hash::make($request->password);
                }
                $user_update->class_id = $request->classes;
                $user_update->roles()->sync($request->roles);

                if (!empty($fileName)) {
                    $user_update->image = $fileName;
                    $file_path = public_path('upload/' . $old_image);
                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                    $image->move('upload', $fileName);
                }

                $user_update->update();

            } catch (\Exception $e) {
                abort(404);
            }
            return redirect()->route('user.index')->with('success', 'C???p nh???t th??nh c??ng');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        if (Gate::allows('isAdmin')) {
            $user_delete = User::find($id);
            if (!empty($user_delete)) {
                $old_image = $user_delete->image;
                if (!empty($old_image)) {
                    $file_path = public_path('upload/' . $old_image);
                    if (File::exists($file_path)) {
                        File::delete($file_path);
                    }
                }
                $user_delete->delete();

                return redirect()->route('user.index')->with('success', 'X??a th??nh c??ng!');
            }
            return abort(404);
        }
    }

    public function account()
    {
        $user = Auth::user();
        if (empty($user)) {
            abort('404');
        }
        return view('admin.users.show', compact('user'));
    }
}
