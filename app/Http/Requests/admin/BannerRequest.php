<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules()
    {
        $rules = [
            'banner_id' => 'required|exists:banners,id',
            'title' => 'required|string|max:255',
            'link_tab' => 'nullable|url',
            'content_button' => 'nullable|string|max:100',
            'description' => 'nullable|string',
            'sort_order' => 'required|integer',
            'status' => 'required|boolean',
        ];

        // Chỉ validate file ảnh khi thêm mới hoặc khi có file được upload
        if ($this->isMethod('post')) {
            $rules['image_desktop'] = 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048';
            $rules['image_mobile'] = 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048';
        } else {
            $rules['image_desktop'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
            $rules['image_mobile'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048';
        }

        return $rules;
    }
    public function messages()
    {
        return [
            'banner_id.required' => 'Vui lòng chọn vị trí banner',
            'title.required' => 'Vui lòng nhập tiêu đề banner',
            'image_desktop.image' => 'File desktop phải là hình ảnh',
            'image_mobile.image' => 'File mobile phải là hình ảnh',
            'image_desktop.max' => 'Hình ảnh desktop không được vượt quá 2MB',
            'image_mobile.max' => 'Hình ảnh mobile không được vượt quá 2MB',
        ];
    }
}
