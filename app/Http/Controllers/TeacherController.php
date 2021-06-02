<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherUpdate;
use App\Model\Roles;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (Gate::allows('view-teacher')) {
            $roles = Roles::find(3);
            return view('admin.teacher.index', compact('roles'));
        } else {
            abort(404);
        }

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
        if (Gate::allows('view-teacher')) {
            $user = User::find($id);
            $teacher = '3';
            $collect = array();
            if (!empty($user)) {
                foreach ($user->roles as $roles) {
                    $collect[] = $roles->id;
                }

                if (in_array(3, $collect)) {
                    return view('admin.teacher.show', compact('user'));
                } else {
                    abort(404);
                }

            } else {
                abort(404);
            }
        } else {
            abort(404);
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
        $user_edit = User::find($id);

        if (Gate::allows('edit-teacher', $user_edit)) {
            if (!empty($user_edit)) {
                $roles = Roles::all();
                $roles_of_user = $user_edit->roles;
                return view('admin.teacher.edit', compact('user_edit', 'roles', 'roles_of_user'));
            } else {
                abort(404);
            }
        } else {
            abort(404);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeacherUpdate $request, $id)
    {
        $teacher = User::find($id);

        if (empty($teacher)) {
            abort(404);
        }

        try {
            $image = $request->file('image');
            if (!empty($image)) {
                $fileName = time() . $image->getClientOriginalName();
            } else {
                $fileName = null;
            }

            $teacher->name = $request->name;
            $teacher->email = $request->email;
            $teacher->phone = $request->phone;
            if (!empty($request->password)) {
                $teacher->password = Hash::make($request->password);
            }
            $teacher->image = $fileName;
            $teacher->birth_day = $request->date;
            $teacher->gender = $request->gender;
            $teacher->class_id = $request->classes;
            $teacher->update();
        } catch (\Throwable $th) {
            abort(404);
        }

        return redirect()->route('teacher.show', ['teacher' => $teacher->id])->with('success', 'Chỉnh sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('delete-teacher')) {
            $teacher_delete = User::find($id);
            $teacher = '3';
            $collect = array();
            if (!empty($teacher_delete)) {

                foreach ($teacher_delete->roles as $roles) {
                    $collect[] = $roles->id;
                }

                if (in_array(3, $collect)) {
                    $teacher_delete->delete();
                    return redirect()->route('teacher.index')->with('success', 'Xóa thành công!');
                } else {
                    abort(404);
                }

            } else {
                abort(404);
            }
        } else {
            abort(404);
        }

    }
}
