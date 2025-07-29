<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BookAddRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'title' => 'required|string|min:3',
                'author' => 'required|string|min:3',
                'descrip_1' => 'required|string',
                'descrip_2' => 'required|string',
                'descrip_3' => 'required|string',
                'title_image' => 'required|image',
                'image' => 'required|string',
                'sort_order' => 'nullable|integer',
                'status' => 'nullable|in:0,1',
            ];
        }
        return [];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Tiêu đề là bắt buộc.',
            'title.string' => 'Tiêu đề phải là một chuỗi ký tự.',
            'title.min' => 'Tiêu đề phải có ít nhất 3 ký tự.',

            'author.required' => 'Tác giả là bắt buộc.',
            'author.string' => 'Tác giả phải là một chuỗi ký tự.',
            'author.min' => 'Tác giả phải có ít nhất 3 ký tự.',

            'descrip_1.required' => 'Mô tả 1 là bắt buộc.',
            'descrip_1.string' => 'Mô tả 1 phải là một chuỗi ký tự.',

            'descrip_2.required' => 'Mô tả 2 là bắt buộc.',
            'descrip_2.string' => 'Mô tả 2 phải là một chuỗi ký tự.',

            'descrip_3.required' => 'Mô tả 3 là bắt buộc.',
            'descrip_3.string' => 'Mô tả 3 phải là một chuỗi ký tự.',

            'title_image.required' => 'Ảnh tiêu đề là bắt buộc.',
            'title_image.image' => 'Ảnh tiêu đề phải là một hình ảnh hợp lệ.',

            'image.required' => 'Hình ảnh là bắt buộc.',
            'image.string' => 'Hình ảnh phải là một chuỗi.',

            'sort_order.integer' => 'Thứ tự sắp xếp phải là một số nguyên.',

            'status.in' => 'Trạng thái phải là 0 hoặc 1.',
        ];
    }
}
