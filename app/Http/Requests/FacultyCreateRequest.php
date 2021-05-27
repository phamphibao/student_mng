<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class FacultyCreateRequest extends FormRequest
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
        return [
            'name' => 'required|unique:faculty,name|max:250',
            'phone' => 'unique:faculty,phone',
            'email' => 'required|unique:faculty,email|max:250',
            'dean_id' => 'required|unique:faculty,dean_id',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên',
            'name.max' => 'Vượt quá số ký tự cho phép',
            'name.unique' => 'Tên đã tồn tại',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'email.required' => 'Vui lòng nhập email',
            'email.max' => 'Vượt quá số ký tự cho phép',
            'email.unique' => 'Email đã tồn tại',
            'dean_id.required' => 'Vui lòng chọn trưởng khoa',
            'dean_id.unique' => 'Trưởng khoa không hợp lệ',
            
        ];
    }
}
