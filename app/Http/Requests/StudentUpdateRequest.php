<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StudentUpdateRequest extends FormRequest
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
    {   $id = $this->route()->parameter('student');
        return [
            'name' => 'required|max:250',
            'email' => 'required|max:250|unique:users,email,'.$id.'',
            'phone' => 'required|max:250|unique:users,phone,'.$id.'',
            'image' => 'mimes:jpeg,bmp,png|image|max:50:',
            'date' =>  'required',
            'gender' => 'required',
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
            'email.max' => 'Vượt quá số ký tự cho phép',
            'email.unique' => 'Email đã tồn tại',
            'phone.required' => 'Vui lòng thêm số điện thoại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'phone.max' => 'Vượt quá số ký tự cho phép',
            'date.required' => 'Thêm ngày tháng năm sinh',
            'gender.required' => 'Chọn giới tính',
            'image.mimes' => 'Ảnh phải có một trong các định dạng sau: jpeg,bmp,png',
            'image.image' => 'File phải là một ảnh',
            'image.max' => 'Ảnh quá lớn',
        ];
    }
}
