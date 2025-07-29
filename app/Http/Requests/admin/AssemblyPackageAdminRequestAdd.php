<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class AssemblyPackageAdminRequestAdd extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'fee' => 'required|numeric',
                'price_assembly' => 'required|numeric',
                'status' => 'required',
                'image' => 'required|image|max:2048',  // Quy định file ảnh
            ];
        }
        return [];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên gói quà không được để trống.',
            'name.string' => 'Tên gói quà phải là một chuỗi ký tự.',
            'name.max' => 'Tên gói quà không được vượt quá 255 ký tự.',

            'description.required' => 'Mô tả không được để trống.',
            'description.string' => 'Mô tả phải là một chuỗi ký tự.',

            'fee.required' => 'Phí không được để trống.',
            'fee.numeric' => 'Phí phải là một số.',

            'price_assembly.required' => 'Giá lắp ráp không được để trống.',
            'price_assembly.numeric' => 'Giá lắp ráp phải là một số.',

            'status.required' => 'Trạng thái không được để trống.',

            'image.required' => 'Hình ảnh không được để trống.',
            'image.image' => 'Tệp hình ảnh không hợp lệ.',
            'image.max' => 'Hình ảnh không được vượt quá 2MB.',
        ];
    }
}
