<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Models\Administration;
use App\Http\Controllers\Controller;
use App\Http\Requests\admin\ForgetPasswordAdminRequest;
use App\Http\Requests\admin\ResetPasswordAdminRequest;
use App\Http\Requests\admin\VerifyCodeAdminRequest;
use App\Http\Requests\LoginAdminRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\admin\VerificationCodeAdmin;

class LoginController extends Controller
{
    private $administrationModel;


    public function __construct()
    {
        $this->administrationModel = new Administration();
    }


    public function logout(Request $request)
    {
        Auth::logout(); // xóa thông tin xác thực của người dùng khỏi phiên làm việc.
        $request->session()->invalidate();  // xóa tất cả dữ liệu trong session ngăn chặn sự dụng phiên cũ
        $request->session()->regenerateToken(); // tạo một CSRF token mới
        $request->session()->flush(); // xóa tất cả dữ liệu trong phiên hiện tại.
        return redirect()->route('adminLoginForm');
    }

    /*---------------------------------------------------------------- */
    public function login(LoginAdminRequest $request)
    {


        $credentials = ['username' => $request->username, 'password' => $request->password];

        // Xác thực dựa trên loại tài khoản
        $adminCheckAccount = $this->administrationModel->administrationCheckLogin($credentials['username']);
        if (!$adminCheckAccount) {
            return redirect()->back()->with(['error' => 'Tài khoản không tồn tại trong hệ thống!']);
        }
        if (auth()->guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            $admin = auth()->guard('admin')->user();

            if ($admin->status >= 1) {
                session()->put('admin', $admin);

                //---------------- start thông báo telegram
                $notification = "Quản trị viên: " . $admin->fullname . "\n";
                $notification .= "Thuộc nhóm quyền: " . $admin->administrationGroup->name . "\n";
                $notification .= "Đã đăng nhập vào hệ thống LEGOLOFT";


                //      $this->sendTelegramMessage('7827918248:AAEPHa9lW5xDFO0pYhkS_orUEF01uFeNzWQ', '-4725825262', $notification);


                //---------------- end thông báo telegram

                return redirect()->route('dashboard')->with('success', 'Đăng nhập quản trị thành công.');
            } else {
                auth()->guard('admin')->logout();
                return redirect()->back()->with('error', 'Tài khoản quản trị của bạn đã bị khóa.');
            }
        }

        // Nếu thông tin không hợp lệ
        return redirect()->back()->with(['error' => 'Tên đăng nhập hoặc mật khẩu không đúng!']);
    }


    public function forgetPasswordAdminForm(ForgetPasswordAdminRequest $request)
    {
        $administration = $this->administrationModel->mailCheck($request->email);
        $code = rand(100000, 999999);
        $administration->verification_code = $code;
        $administration->save();
        Mail::to($administration->email)->send(new VerificationCodeAdmin($code));
        return redirect()->route('codePasswordAdmin')->with(['email' => $request->email, 'success' => 'Mã xác nhận đã được gửi, vui lòng kiểm tra Mail.']);
    }

    public function codePasswordAdminForm(VerifyCodeAdminRequest $request)
    {
        $administration = $this->administrationModel->mailCheck($request->email);

        if ($administration->verification_code == $request->verification_code) {
            return redirect()->route('reenterPasswordAdmin')->with('email', $request->email);
        } else {
            return redirect()->route('codePasswordAdmin')->with('error', 'Mã xác nhận không hợp lệ!');
        }
    }

    public function reenterPasswordAdminForm(ResetPasswordAdminRequest $request)
    {
        $administration = $this->administrationModel->mailCheck($request->email);
        $administration->password = bcrypt($request->password);
        $administration->verification_code = null;
        $administration->save();
        return redirect()->route('adminLogin')->with('success', 'Mật khẩu đã được thay đổi thành công');
    }

    public function sendTelegramMessage($botToken, $chatId, $message)
    {
        $url = "https://api.telegram.org/bot{$botToken}/sendMessage";
        $data = [
            'chat_id' => $chatId,
            'text' => $message,
            'parse_mode' => 'Markdown' // Hoặc 'HTML' nếu bạn muốn định dạng khác
        ];

        // Sử dụng cURL để gửi yêu cầu
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Thực thi và lấy kết quả
        $response = curl_exec($ch);
        curl_close($ch);

        return $response;
    }
}
