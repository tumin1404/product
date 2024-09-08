<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Login</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app-light.css') }}">
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/simplebar.css') }}">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/feather.css') }}">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>
<body>
    <div class="wrapper vh-100">
      <div class="row align-items-center h-100">
        <form id="LoginForm" class="col-lg-3 col-md-4 col-10 mx-auto text-center" action="{{ route('admin.login.post') }}" method="POST">
            @csrf
            <h1 class="mb-3">ĐĂNG NHẬP</h1>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="form-group">
                <label for="username" class="sr-only">Tài khoản</label>
                <input type="text" id="username" name="username" class="form-control form-control-lg" placeholder="Tài khoản" required autofocus>
            </div>
            <div class="form-group">
                <label for="password" class="sr-only">Mật khẩu</label>
                <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Mật khẩu" required>
            </div>
            <div class="text-left">
                <li id="length" class="default">Độ dài tối thiểu 8 kí tự</li>
                <li id="uppercase" class="default">Có ít nhất 1 chữ IN HOA</li>
                <li id="lowercase" class="default">Có ít nhất 1 chữ thường</li>
                <li id="special" class="default">Có ít nhất 1 kí tự đặc biệt</li>
            </div>
            <div>
                <button id="submitBtn" class="btn btn-lg btn-secondary btn-block" type="submit" disabled>Đăng nhập</button>
            </div>
            
            <p class="mt-5 mb-3 text-muted">© 2024</p>
        </form>
      </div>
    </div>
<script>
    const password = document.getElementById('password');
    const lengthRequirement = document.getElementById('length');
    const uppercaseRequirement = document.getElementById('uppercase');
    const lowercaseRequirement = document.getElementById('lowercase');
    const specialRequirement = document.getElementById('special');

    document.getElementById('LoginForm').addEventListener('input', function() {
      const username = document.getElementById('username').value;
      const password = document.getElementById('password').value;
      const submitBtn = document.getElementById('submitBtn');

    if (username &&  password) {
      submitBtn.disabled = false;
      submitBtn.classList.remove('btn-secondary');
      submitBtn.classList.add('btn-primary');
    } else {
      submitBtn.disabled = true;
      submitBtn.classList.remove('btn-primary');
      submitBtn.classList.add('btn-secondary');
    }
  });

    password.addEventListener('input', function() {
        const value = password.value;

        // Kiểm tra độ dài
        if (value.length >= 8) {
            lengthRequirement.style.color = 'green';
        } else {
            lengthRequirement.style.color = 'red';
        }

        // Kiểm tra chữ IN HOA
        if (/[A-Z]/.test(value)) {
            uppercaseRequirement.style.color = 'green';
        } else {
            uppercaseRequirement.style.color = 'red';
        }

        // Kiểm tra chữ thường
        if (/[a-z]/.test(value)) {
            lowercaseRequirement.style.color = 'green';
        } else {
            lowercaseRequirement.style.color = 'red';
        }

        // Kiểm tra kí tự đặc biệt
        if (/[!@#$%^&*(),.?":{}|<>]/.test(value)) {
            specialRequirement.style.color = 'green';
        } else {
            specialRequirement.style.color = 'red';
        }
    });
</script>
<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/moment.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.stickOnScroll.js') }}"></script>
<script src="{{ asset('assets/js/tinycolor-min.js') }}"></script>
<script src="{{ asset('assets/js/config.js') }}"></script>
<script src="{{ asset('assets/js/apps.js') }}"></script>
</body>
</html>