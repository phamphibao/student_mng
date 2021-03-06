<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class TeacherUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->route()->parameter('teacher');
       
        return [
            'name' => 'required|max:250',
            "email" => 'required|unique:users,email,'.$id.'',
            'password' => 'confirmed',
            'phone' => 'required|unique:users,phone,'.$id.'',
            "date" => 'required',
            "gender" => 'required',
            "image" => 'mimes:jpeg,bmp,png|image|max:50:'
        ];
       
    }

     /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên',
            'name.max' => 'Vượt quá số ký tự cho phép',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email đã tồn tại',
            'password.confirmed' => 'Mật khẩu không khớp',
            'phone.required' => 'Vui lòng thêm số điện thoại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'date.required' => 'Thêm ngày tháng năm sinh',
            'gender.required' => 'Chọn giới tính',
            'image.mimes' => 'Ảnh phải có một trong các định dạng sau: jpeg,bmp,png',
            'image.image' => 'File phải là một ảnh',
            'image.max' => 'Ảnh quá lớn',
        ];
    }
}
