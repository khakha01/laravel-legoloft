<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserAdminRequest extends FormRequest
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
    public function rules(): array
    {
        if ($this->isMethod('post')) {
            return [
                'fullname' => 'required|string|max:255',
                'name'     => 'required|string|max:255',
                'email'    => 'required|string|email|max:255|unique:users',
                'password' => 'required|confirmed',
                'phone'    => 'required|max:10',
                'province' => 'required',
                'district' => 'required',
                'ward'     => 'required',
                'address'  => 'required',
                'status'   => 'required',
                'status'       => 'required|in:0,1', // Chỉ cho phép 0 hoặc 1
                'user_group_id'  => 'required',
            ];
        }
        return [];
    }

    public function messages(): array
    {
        return [
            'fullname.required' => 'Họ và tên là bắt buộc.',
            'name.required'     => 'Tên là bắt buộc.',
            'email.required'    => 'Email là bắt buộc.',
            'email.email'       => 'Email không hợp lệ.',
            'email.unique'      => 'Email đã tồn tại.',
            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.max'         => 'Số điện thoại không được vượt quá 10 ký tự.',
            'province.required' => 'Tỉnh là bắt buộc.',
            'district.required' => 'Quận/Huyện là bắt buộc.',
            'ward.required'     => 'Phường/Xã là bắt buộc.',
            'address.required'  => 'Địa chỉ là bắt buộc.',
            'status.required'   => 'Trạng thái là bắt buộc.',
            'status.in'        => 'Trạng thái phải là 0 (Vô hiệu hóa) hoặc 1 (Kích hoạt).',
            'user_group_id.required' => 'Nhóm khách hàng là bắt buộc.',
        ];
    }
}
