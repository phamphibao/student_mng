<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class RolesRequest extends FormRequest
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
            'name' => 'required|max:250|unique:roles,name',
            'detail' => 'required|max:250'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập tên',
            'name.max' => 'Vượt quá số ký tự cho phép',
            'name.unique' => 'Quyền đã tồn tại',
            'detail.required' => 'Vui lòng nhập thông tin chi tiết',
            'detail.max' => 'Vượt quá số ký tự cho phép',
            
        ];
    }
}
