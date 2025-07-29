<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class BannerManageEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('put')) {
            return [
                'name' => 'required|string|max:255',
                'position' => 'required|string|max:100',
                'status' => 'required|in:0,1',
            ];
        }
        return [];
    }
    public function messages(): array
    {
        return [
            'name.required' => 'Trường tên là bắt buộc.',
            'name.string' => 'Tên phải là một chuỗi.',
            'name.max' => 'Tên không được vượt quá 255 ký tự.',
            'position.required' => 'Trường vị trí là bắt buộc.',
            'position.string' => 'Vị trí phải là một chuỗi.',
            'position.max' => 'Vị trí không được vượt quá 100 ký tự.',
            'status.required' => 'Trường trạng thái là bắt buộc.',
            'status.in' => 'Trạng thái đã chọn không hợp lệ.',
        ];
    }
}
