<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserUpdateRequest extends FormRequest
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
        $id = $this->route()->parameter('user');
        return [
            'name' => 'required|max:250',
            "email" => 'required|unique:users,email,'.$id.'',
            'phone' => 'unique:users,phone,'.$id.'',
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
            'phone.required' => 'Vui lòng thêm số điện thoại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'password.max' => 'Mật khẩu quá dài',
            'password.confirmed' => 'Mật khẩu không khớp',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'date.required' => 'Thêm ngày tháng năm sinh',
            'gender.required' => 'Chọn giới tính',
            'image.mimes' => 'Ảnh phải có một trong các định dạng sau: jpeg,bmp,png',
            'image.image' => 'File phải là một ảnh',
            'image.max' => 'Ảnh quá lớn',
        ];
    }
}
