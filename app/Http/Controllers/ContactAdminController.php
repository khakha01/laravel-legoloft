<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Mail\RepUserContact;

class ContactAdminController extends Controller
{

    public function contact(Request $request)
    {
        // Khởi tạo truy vấn cho Contact
        $contact = Contact::query();

        // Kiểm tra nếu có giá trị filter_status, áp dụng bộ lọc
        if ($request->filled('filter_status') && $request->filter_status !== '') {
            // Nếu filter_status có giá trị và không phải rỗng, áp dụng điều kiện where
            $contact->where('status', $request->filter_status);
        }

        // Sắp xếp và lấy tất cả dữ liệu đã lọc
        $contact = $contact->orderBy('created_at', 'DESC')->get();

        // Trả về view với dữ liệu đã lọc
        return view('admin.contact', compact('contact'));
    }



    public function contactEdit($id)
    {
        $findcontact = Contact::find($id);
        return view('admin.contactEdit', compact('findcontact'));
    }

    // Hiển thị form phản hồi
    public function contactMail($id)
    {
        $response = $this->adminstrationGroupCrud('contactResponse');
        if ($response) {
            return $response;
        }
        // Tìm contact theo ID
        $contact = Contact::findOrFail($id);

        // Kiểm tra nếu không tìm thấy liên hệ
        if (!$contact) {
            return redirect()->back()->with('error', 'Không tìm thấy liên hệ!');
        }

        // Truyền biến $contact vào view
        return view('admin.contactMail', compact('contact'));
    }

    public function sendReply(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        // Validate dữ liệu
        $request->validate([
            'message' => 'required|string',
        ]);
        $message =  $request->message; // Ép kiểu chuỗi
        Mail::to($contact->email)->send(new \App\Mail\RepUserContact($contact, $message));
        $contact->update(['status' => 1]);
        return redirect()->route('contactAdmin')->with('success', 'Phản hồi đã được gửi thành công!');
    }





    public function updateContactStatus(Request $request, $id)
    {
        $contact = Contact::findOrFail($id);
        $contact->status = $request->status;
        $contact->save();

        return response()->json(['success' => true]);
    }

    // ContactAdminController.php
    public function filter_status(Request $request)
    {
        // Lấy giá trị filter_status từ request
        $filterStatus = $request->input('filter_status');

        // Tạo query tìm các liên hệ
        $contactsQuery = Contact::query();

        // Nếu có giá trị filter_status và nó không phải là rỗng, thêm điều kiện lọc
        if ($filterStatus !== '') {
            $contactsQuery->where('status', $filterStatus);
        }

        // Lấy danh sách liên hệ đã lọc
        $contact = $contactsQuery->get();

        // Trả về view với danh sách liên hệ đã lọc
        return view('admin.contact', compact('contact'));
    }

    public function deleteContactCheckbox(Request $request)
    {
        $response = $this->adminstrationGroupCrud('contactDeleteCheckbox');
        if ($response) {
            return $response;
        }
        $contact_ids = $request->input('contact_id');
        if ($contact_ids) {
            foreach ($contact_ids as $itemID) {
                $contact = Contact::findOrFail($itemID);
                if ($contact->status == 0) {
                    return redirect()->route('contactAdmin')->with('error', 'Liên hệ này chưa được phẩn hồi, vui lòng phản hồi trước khi xóa!');
                }
                $contact->delete();
            }
            return redirect()->route('contactAdmin')->with('success', 'Xóa những liên hệ thành công');
        }
    }

    public function adminstrationGroupCrud($action = null)
    {
        $admin = auth()->guard('admin')->user();
        $permissionGet = json_decode($admin->administrationGroup->permission, true);

        $permissionArray = [
            'contactResponse' => 'Bạn không có quyền phản hồi liên hệ.',
            'contactDeleteCheckbox' => 'Bạn không có quyền xóa liên hệ.',
        ];
        if ($action === null) {
            foreach ($permissionArray as $permiss => $errorMessage) {
                if (!in_array($permiss, $permissionGet)) {
                    return redirect()->back()->with('error', $errorMessage);
                }
            }
        } else {
            if (array_key_exists($action, $permissionArray)) {
                if (!in_array($action, $permissionGet)) {
                    return redirect()->back()->with('error', $permissionArray[$action]);
                }
            }
        }
    }
}
