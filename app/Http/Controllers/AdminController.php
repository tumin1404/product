<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    // Show the signup form
    public function showSignupForm()
    {
        return view('admin.page.signup');
    }

    // Handle the signup form submission
    public function signup(Request $request)
    {
        try {
            // Xác thực dữ liệu
            $request->validate([
                'username' => 'required|string|max:255|unique:users',
                'password' => [
                    'required',
                    'string',
                    'min:8',             // Độ dài tối thiểu 8 ký tự
                    'regex:/[a-z]/',      // Phải có ít nhất một chữ thường
                    'regex:/[A-Z]/',      // Phải có ít nhất một chữ hoa
                    'regex:/[0-9]/',      // Phải có ít nhất một số
                    'regex:/[@$!%*?&#]/'  // Phải có ít nhất một ký tự đặc biệt
                ],
                'display_name' => 'required|string|max:255',
                'role' => 'required|string|in:admin,content',
            ], [
                'password.min' => 'Mật khẩu phải có độ dài tối thiểu 8 ký tự.',
                'password.regex' => 'Mật khẩu phải chứa ít nhất một chữ thường, một chữ hoa, một số và một ký tự đặc biệt.',
            ]);

            // Tạo người dùng mới
            $user = new User();
            $user->username = $request->username;
            $user->password = Hash::make($request->password);
            $user->display_name = $request->display_name;
            $user->role = $request->role;
            $user->save();

            // Chuyển hướng lại trang đăng ký với thông báo thành công
            return redirect()->route('admin.signup')->with('success', 'Đăng ký tài khoản thành công! Vui lòng đăng nhập.');
        } catch (\Exception $e) {
            // Chuyển hướng lại trang đăng ký với thông báo lỗi
            return redirect()->back()->with('error', 'Đăng ký tài khoản thất bại! Vui lòng thử lại.');
        }
    }
    // Hiển thị form đăng nhập
    public function showLoginForm()
    {
        return view('admin.page.login');
    }

    // Xử lý đăng nhập
    public function login(Request $request)
    {
        // Xác thực dữ liệu
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Thử xác thực người dùng và đăng nhập
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            // Nếu đăng nhập thành công, chuyển hướng đến trang home
            return redirect()->route('admin.home');
        } else {
            // Nếu đăng nhập thất bại, trả về trang đăng nhập với thông báo lỗi
            return back()->with('error', 'Tài khoản hoặc mật khẩu không đúng.');
        }
    }

    // Hiển thị trang home sau khi đăng nhập thành công
    public function home()
    {
        return view('admin.page.home');
    }

    public function logout(Request $request)
{
    // Đăng xuất người dùng
    Auth::logout();

    // Hủy session
    $request->session()->invalidate();

    // Tạo lại token CSRF để bảo mật
    $request->session()->regenerateToken();

    // Chuyển hướng về trang đăng nhập
    return redirect()->route('admin.login');
}
}
