<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Contact;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\VerificationCode;
use App\Mail\VerifycationEmail;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\LoginValidate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\VerifyCodeRequest;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\ForgetPasswordRequest;


class UserController extends Controller
{
    private $userModel;
    private $orderModel;

    public function __construct()
    {
        $this->userModel = new User();
        $this->orderModel = new Order();
    }

    public function login(LoginValidate $request)
    {

        $user = $this->userModel->checkAccount($request->email);
        if (!$user) {
            return redirect()->route('login')->with('error', 'Tài khoản không tồn tại trong hệ thống!');
        }


        if (auth()->attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();
            if ($user->status < 1) {
                return redirect()->route('login')->with('error', 'Tài khoản bạn đã bị khóa');
            }
            session()->put('user', $user);
            return redirect('/')->with('success', 'Đăng nhập thành công');
        }
        return redirect()->route('login')->with('error', 'Email hoặc password của bạn đã sai!');
    }


    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => bcrypt(Str::random(16)),
                ]);
            }

            Auth::login($user);
            session()->put('user', $user);
            Log::info('Đăng nhập Google thành công: ', ['id' => $user->id]);
            return redirect('/')->with('success', 'Đăng nhập thành công');
        } catch (\Exception $e) {
            Log::error('Google OAuth Error: ' . $e->getMessage());
            return redirect('/login')->with('error', 'Đăng nhập bằng Google thất bại');
        }
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerate();
        return redirect()->route('login')->with('success', 'Đăng nhập tại đây');
    }

    public function forgetPassword(ForgetPasswordRequest  $request)
    {
        //Tạo mã ranđom code
        $code = rand(100000, 999999);
        // kiểm tra tài khoản email trong system
        $user = $this->userModel->checkAccount($request->email);
        //tiến hành update mã code
        $user->verification_code = $code;
        $user->save();
        // gửi mail
        Mail::to($user->email)->send(new VerificationCode($code));
        return redirect()->route('confirmationCodePassword')->with('email', $request->email);
    }

    public function confirmationPassword(VerifyCodeRequest  $request)
    {
        // Kiểm tra tài khoản email trong hệ thống
        $user = $this->userModel->checkAccount($request->email);

        if ($user->verification_code == $request->verification_code) {
            return redirect()->route('resetPassword')->with('email', $request->email);
        } else {
            return redirect()->route('confirmationCodePassword')->with('error', 'Mã xác nhận không hợp lệ');
        }
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        // kiểm tra tài khoản email trong system
        $user = $this->userModel->checkAccount($request->email);
        $user->password = bcrypt($request->password);
        $user->verification_code = null;
        $user->save();
        return redirect()->route('login')->with('success', 'Mật khẩu đã được thay đổi thành công');
    }


    public function register(RegisterRequest $request)
    {
        // Kiểm tra xem tài khoản đã tồn tại hay chưa
        $existingUser = $this->userModel->checkAccount($request->email);
        if ($existingUser) {
            return redirect()->route('register')->with('error', 'Email đã tồn tại trong hệ thống');
        }

        // Tạo tài khoản mới
        $user = new User();
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->phone = ltrim($request->phone);
        $user->password = bcrypt($request->password);
        $user->status = 0; // 1 = active, 0 = inactive
        $user->image = "user1.jpg";

        //
        $verificationCodeEmail = rand(100000, 999999);
        $user->verification_code  = $verificationCodeEmail;

        try {
            // Gửi email chào mừng
            Mail::to($user->email)->send(new VerifycationEmail($user, $verificationCodeEmail));

            session(['verification_mailUser' => $user]);

            return redirect()->route('verifyEmail')->with('success', 'Vui lòng kiểm tra email để xác nhận tài khoản của bạn.');
        } catch (\Throwable $th) {
            // Bắt các lỗi khác
            return redirect()->route('register')->with('error', 'Đã có lỗi xảy ra. Vui lòng thử lại sau.');
        }
    }



    public function verifyEmail(Request $request)
    {
        $user = session('verification_mailUser');


        if (!$user || $user->verification_code != $request->verification_code) {
            return redirect()->route('verifyEmail')->with('error', 'Mã xác thực không hợp lệ.');
        }
        $user->email_verified_at = now();
        $user->status = 1; // Kích hoạt tài khoản
        $user->verification_code  = null;
        $user->save();

        // Xóa thông tin người dùng khỏi session
        session()->forget('verification_mailUser');

        return redirect()->route('login')->with('success', 'Email xác thực thành công');
    }

    /*-------------------------------------- */
    public function contact()
    {
        return view('contact');
    }
    public function submitContact(Request $request)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Lưu vào cơ sở dữ liệu
        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
        ]);

        return redirect()->route('contact')->with('success', 'Cảm ơn bạn đã gửi phản hồi!');
    }
}
