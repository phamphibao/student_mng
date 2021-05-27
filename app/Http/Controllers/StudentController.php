<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Roles;
use App\Model\User;
use App\Model\Classes;
use App\Http\Requests\StudentUpdateRequest;
use Illuminate\Support\Facades\Gate;
use File;
class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        if (Gate::allows('view-student')) {
            $users = Roles::find(2)->Users()->get();
            return view('admin.students.index',['users' =>  $users]);
        }{
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
        if (Gate::allows('view-student')) {
            $user = User::find($id);
            return view('admin.students.show',['user' => $user]);
        }{
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
        if (Gate::allows('edit-student')) {
            $id_roles_student = 2;
            $student = User::find($id);
            if ($student) {
                $classes = Classes::all(); 
                $roles = $student->roles;
                if($roles->contains($id_roles_student)){
                    return view('admin.students.edit',['student' => $student,'classes' => $classes]);
                }else{
                    abort(404);
                }
            }else{
                abort(404);
            }
        }else{
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
    public function update(StudentUpdateRequest $request, $id)
    {
        if (Gate::allows('edit-student')) {
            $id_roles_student = 2;
            $student_update = User::find($id);
            if ($student_update) {
                $roles = $student_update->roles;
                if($roles->contains($id_roles_student)){

                    $old_image   = $student_update->image;
                    $image = $request->file('image');
                    if(!empty($image)){
                        $fileName = time().$image->getClientOriginalName();
                    }else{
                        $fileName = null;
                    }
                        try {
                        
                            $student_update->name  = $request->name;
                            $student_update->email  = $request->email;
                            $student_update->phone = $request->phone;
                            $student_update->birth_day  =  $request->date;
                            $student_update->gender  = $request->gender;
                            $student_update->class_id  = $request->classes;
            
                            if (!empty($fileName)) {
                                $student_update->image  = $fileName;
                                $file_path = public_path('upload/'.$old_image);
                                if (File::exists($file_path)) {
                                    File::delete($file_path);
                                }
                                $image->move('upload', $fileName);
                            }
            
                            $student_update->update();
            
                        } catch (\Exception  $e) {
                            abort(404);
                        }
                        return redirect()->route('student.show',['student' => $student_update->id])->with('success','Cập nhật thành công');
                }else{
                    abort(404);
                }
            }else{
                abort(404);
            }
        }else{
            abort(404);
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
        if (Gate::allows('delete-student')) {
            $student_delete = User::find($id);
            $id_roles_student = 2;
            if ($student_delete) {
                $roles = $student_delete->roles;
                if($roles->contains($id_roles_student)){
                    $student_delete->delete();
                    return redirect()->route('student.index')->with('success','Xóa Thành công');
                }else{
                    abort(404);
                }
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
        
    }
}
