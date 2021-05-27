<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Classes;
use App\Model\User;
use App\Http\Requests\ClassesStoreRequest;
use App\Http\Requests\ClassesUpdateRequest;
use Illuminate\Support\Facades\Gate;
class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        if (Gate::allows('view-class')) {
            $classes = Classes::paginate(10);
            return view('admin.classes.index',compact('classes'));
        }else{
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
        if (Gate::allows('add-class')) {
            $teachers = User::all();
        
            if(!empty($teachers)){
                return view('admin.classes.create',['teachers' => $teachers]);
            }else{
                return redirect()->back()->with('warning','Hiện tại vẫn chưa có giáo viên nào, bạn cần tạo giáo viên trước khi tạo lớp');
            }
        }else{
            abort(404);
        }
      
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassesStoreRequest $request)
    {
        try {
            $class = Classes::create($request->all());
        } catch (\Throwable $th) {
            return redirect()->back()->with('warning','Có lỗi, vui lòng thử lại sau!');
        }
        return redirect()->route('class.index')->with('success','Thêm thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Gate::allows('edit-class')){
            $class = Classes::find($id);
            $teachers = User::all();
            if(!empty($class)){
                return view('admin.classes.edit',compact('class','teachers'));
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
    public function update(ClassesUpdateRequest $request, $id)
    {
        $class = Classes::find($id);

        if (!empty($class)) {
            try {
                $class->update($request->all());
            } catch (\Throwable $th) {
                return back()->with('warning','Có lỗi xảy ra vui lòng thử lại sau!');
            }

            return redirect()->route('class.index')->with('success','Chỉnh sửa thành công!');
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
        if(Gate::allows('delete-class')){
            $class_delete = Classes::find($id);
            if (!empty($class_delete)) {
                $class_delete->delete();
                return back()->with('success','Xóa thành công!');
            }else{
                abort(404);
            }
        }else{
            abort(404);
        }
        
    }
}
