<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Http\FormRequest;

class ClassesStoreRequest extends FormRequest
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
            'name' => 'required|max:250|unique:classes,name',
            'teacher_id' => 'required|unique:classes,teacher_id'
        ];
    }
    
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên',
            'name.max' => 'Vượt quá số ký tự cho phép',
            'name.unique' => 'Tên đã tồn tại',
            'teacher_id.required' => 'Vui lòng chọn giáo viên chủ nhiệm',
            'teacher_id.unique' => 'Giáo viên này đã có lớp',
            
        ];
    }
}
