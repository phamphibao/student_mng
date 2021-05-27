<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RolesUpdateRequest extends FormRequest
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
            'detail' => 'required|max:250'
        ];
    }

    public function messages()
    {
        return [
            'detail.required' => 'Vui lòng nhập thông tin chi tiết',
            'detail.max' => 'Vượt quá số ký tự cho phép',
            
        ];
    }
}
