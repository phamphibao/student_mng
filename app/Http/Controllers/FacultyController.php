<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Faculty;
use App\Model\User;
use App\Http\Requests\FacultyCreateRequest;
use App\Http\Requests\FacultyUpdateRequest;
use Illuminate\Support\Facades\Gate;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Gate::allows('view-faculty')){
        $faculty = Faculty::paginate(10);
        return view('admin.faculty.index',compact('faculty'));
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
        if (Gate::allows('add-faculty')) {
            $user = User::all();
            return view('admin.faculty.create',compact('user'));
        }else {
            abort(404);
        }
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacultyCreateRequest $request)
    {
        $faculty = Faculty::create($request->all());

        return redirect()->route('faculty.index')->with('success','Thêm thành công');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        if (Gate::allows('edit-faculty')) {
            $faculty = Faculty::find($id);
            $user    = User::all();
            return view('admin.faculty.edit',compact('faculty','user'));
        }else {
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
    public function update(FacultyUpdateRequest $request, $id)
    {
        $faculty_update = Faculty::find($id);

        if(!empty($faculty_update)){
            $faculty_update->update($request->all());
        }
        return redirect()->route('faculty.index')->with('success','Chỉnh sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Gate::allows('delete-faculty')) {
            $faculty_delete = Faculty::find($id);
        
            if(!empty($faculty_delete)){
                $faculty_delete->delete();
            }else{
                return abort(404);
            }
            return back()->with('success','Xóa thành công!');
        }else {
            abort(404);
        }
       

    }
}
