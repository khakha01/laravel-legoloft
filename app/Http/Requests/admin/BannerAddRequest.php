<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class BannerAddRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return [
                'title.*' => 'required|string|max:255',
                'image_desktop.*' => 'required|image',
                'image_mobile.*' => 'required|image',
                'link_tab.*' => 'nullable|url',
                'content_button.*' => 'nullable|string|max:255',
                'sort_order.*' => 'required|integer|min:1',
                'status.*' => 'required|in:0,1',
                'description.*' => 'nullable|string|max:500',
            ];
        }
        return [];
    }


    public function messages(): array
    {
        return [
            'title.*.required' => 'Tiêu đề là bắt buộc.',
            'image_desktop.*.required' => 'Hình ảnh desktop là bắt buộc.',
            'image_mobile.*.required' => 'Hình ảnh mobile là bắt buộc.',
            'link_tab.*.url' => 'Liên kết không hợp lệ.',
            'content_button.*.nullable' => 'Nội dung button không được quá dài.',
            'sort_order.*.required' => 'Thứ tự xuất hiện là bắt buộc.',
            'status.*.required' => 'Trạng thái là bắt buộc.',
            'description.*.nullable' => 'Mô tả không được quá dài.',
        ];
    }
}
