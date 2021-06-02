<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Roles;
use App\Model\Permission;
use App\Http\Requests\RolesRequest;
use App\Http\Requests\RolesUpdateRequest;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Roles::where('id','!=',1)->paginate(10);

        return view('admin.roles.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permission = Permission::where('id_parent',0)->get();
        return view('admin.roles.create',compact('permission'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolesRequest $request)
    {
        try {
            $roles = Roles::create($request->all());
            $roles->permission()->attach($request->permission);
        } catch (\Throwable $th) {
            abort(404);
        }
     
        
        return redirect()->route('roles.index')->with('success','Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $roles = Roles::find($id);
       
        if (!empty($roles)) {
            return view('admin.roles.show',compact('roles'));
        }else{
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
        $roles_edit = Roles::find($id);
        $permission = Permission::where('id_parent',0)->get();
        $permission_of_roles = $roles_edit->permission;
       
        return view('admin.roles.edit',compact('roles_edit','permission','permission_of_roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolesUpdateRequest $request, $id)
    {  
       

        try {
            $roles_update = Roles::find($id);
            $roles_update->update($request->all());
            $roles_update->permission()->sync($request->permission);
        } catch (\Throwable $th) {
            abort(404);
        }

        return redirect()->route('roles.index')->with('success','Cập nhật thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        if ($id === '1' || $id === '2' || $id === '3') {
           return abort(404);
        }
        $roles_delete = Roles::find($id);
        if(!empty($roles_delete)){
            $roles_delete->delete();
        }else{
            abort(404);
        }

        return redirect()->route('roles.index')->with('success','Xóa thành công');
    }

}
