<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin Signup</title>
    <link rel="stylesheet" href="{{ asset('assets/css/app-light.css') }}">
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/simplebar.css') }}">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/feather.css') }}">
    <style>
      .default {
            color: gray;
        }
      .valid {
          color: green;
      }
      .invalid {
          color: red;
      }
    </style>
</head>
<body>
  <!-- Thông báo thành công với Modal -->
  @if(session('success'))
  <div id="successModal" class="modal wrapper vh-100" style="display:block;">
    <div class="modal-content">
      <span class="close">&times;</span>
      <p>{{ session('success') }}</p>
      <button id="redirectBtn">OK</button>
    </div>
  </div>
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            {{-- <h5 class="modal-title" id="defaultModalLabel">Thông báo</h5> --}}
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">{{ session('success') }}</div>
          <div class="modal-footer">
            <button id="redirectBtn" type="button" class="btn mb-2 btn-primary">Đăng nhập</button>
          </div>
        </div>
      </div>
    </div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
  @endif

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  <div class="wrapper vh-100">
    <div class="row align-items-center h-100">
      <form id="registrationForm" class="col-lg-6 col-md-8 col-10 mx-auto" action="{{ route('admin.signup') }}" method="POST">
        @csrf
        <div class="mx-auto text-center my-4">
          <h2 class="my-3">TẠO TÀI KHOẢN</h2>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="username">Tên tài khoản</label>
            <input type="text" class="form-control" id="username" name="username" required>
          </div>
          <div class="form-group col-md-6">
            <label for="display_name">Tên hiển thị</label>
            <input type="text" class="form-control" id="display_name" name="display_name" required>
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="password">Mật khẩu</label>
            <input type="password" class="form-control" id="password" name="password" required>
          </div>
          <div class="form-group col-md-6">
            <label for="ConfirmPassword">Xác nhận mật khẩu</label>
            <input type="password" class="form-control" id="ConfirmPassword">
          </div>
        </div>
        <div class="form-row">
          <div class="form-group col-md-6">
            <label for="role">Chức vụ</label>
            <select class="form-control col-md-6" id="role" name="role" required>
              <option>------ Chọn ------</option>
              <option value="admin">Admin</option>
              <option value="content">Content</option>
            </select>
          </div>
          <div class="form-group col-md-6">
            <p class="mb-2">Yêu cầu mật khẩu</p>
            <ul class="small text-muted pl-4 mb-0">
              <li id="length" class="default">Độ dài ít nhất 8 kí tự</li>
              <li id="uppercase" class="default">Có ít nhất 1 chữ IN HOA</li>
              <li id="lowercase" class="default">Có ít nhất 1 chữ thường</li>
              <li id="number" class="default">Có ít nhất 1 chữ số</li>
            </ul>
          </div>
        </div>
        <button id="submitBtn" class="btn btn-lg btn-secondary btn-block" type="submit" disabled>Đăng kí</button>
        <div class="col align-self-center p-3">
          <p class="text-center mr-auto">Bạn đã có tài khoản?</h2>
          <a href="/admin/login">Đăng nhập</p>
        </div>
        
      </form>
    </div>
  </div>
<p class="mt-5 mb-3 text-muted text-center">© 2024</p>
  <script>
    const password = document.getElementById('password');
    const confirmPassword = document.getElementById('ConfirmPassword');
    const length = document.getElementById('length');
    const uppercase = document.getElementById('uppercase');
    const lowercase = document.getElementById('lowercase');
    const number = document.getElementById('number');
    const submitBtn = document.getElementById('submitBtn');
    const username = document.getElementById('username');
    const displayName = document.getElementById('display_name');
    const role = document.getElementById('role');

    document.getElementById('registrationForm').addEventListener('input', function() {
      const username = document.getElementById('username').value;
      const displayName = document.getElementById('display_name').value;
      const role = document.getElementById('role').value;
      const password = document.getElementById('password').value;
      const confirmPassword = document.getElementById('ConfirmPassword').value;
      const submitBtn = document.getElementById('submitBtn');

    if (username && displayName && password && confirmPassword && (role === 'admin' || role === 'content')) {
      submitBtn.disabled = false;
      submitBtn.classList.remove('btn-secondary');
      submitBtn.classList.add('btn-primary');
    } else {
      submitBtn.disabled = true;
      submitBtn.classList.remove('btn-primary');
      submitBtn.classList.add('btn-secondary');
    }
  });

    // Khi người dùng bấm vào ô nhập mật khẩu, chuyển các điều kiện sang màu đỏ
    password.addEventListener('focus', function() {
        length.classList.remove('default');
        length.classList.add('invalid');

        uppercase.classList.remove('default');
        uppercase.classList.add('invalid');

        lowercase.classList.remove('default');
        lowercase.classList.add('invalid');

        number.classList.remove('default');
        number.classList.add('invalid');
    });

    // Khi người dùng rời khỏi ô nhập mật khẩu, chuyển các điều kiện về màu xám (default)
    password.addEventListener('blur', function() {
        if (!password.value || password.value.length < 8) {
            length.classList.remove('invalid', 'valid');
            length.classList.add('default');
        }

        if (!/[A-Z]/.test(password.value)) {
            uppercase.classList.remove('invalid', 'valid');
            uppercase.classList.add('default');
        }

        if (!/[a-z]/.test(password.value)) {
            lowercase.classList.remove('invalid', 'valid');
            lowercase.classList.add('default');
        }

        if (!/\d/.test(password.value)) {
            number.classList.remove('invalid', 'valid');
            number.classList.add('default');
        }
    });

    password.addEventListener('input', function() {
        const value = password.value;

        // Kiểm tra độ dài
        if (value.length >= 8) {
            length.classList.remove('invalid');
            length.classList.add('valid');
        } else {
            length.classList.remove('valid');
            length.classList.add('invalid');
        }

        // Kiểm tra chữ IN HOA
        if (/[A-Z]/.test(value)) {
            uppercase.classList.remove('invalid');
            uppercase.classList.add('valid');
        } else {
            uppercase.classList.remove('valid');
            uppercase.classList.add('invalid');
        }

        // Kiểm tra chữ thường
        if (/[a-z]/.test(value)) {
            lowercase.classList.remove('invalid');
            lowercase.classList.add('valid');
        } else {
            lowercase.classList.remove('valid');
            lowercase.classList.add('invalid');
        }

        // Kiểm tra chữ số
        if (/\d/.test(value)) {
            number.classList.remove('invalid');
            number.classList.add('valid');
        } else {
            number.classList.remove('valid');
            number.classList.add('invalid');
        }
    });

    // Kiểm tra mật khẩu xác nhận khi người dùng nhập
    confirmPassword.addEventListener('input', function() {
        if (confirmPassword.value === password.value && confirmPassword.value !== "") {
            confirmPassword.style.color = 'green';
        } else {
            confirmPassword.style.color = 'red';
        }
    });

    // Khi người dùng rời khỏi ô xác nhận mật khẩu, đặt lại màu về mặc định (gray)
    confirmPassword.addEventListener('blur', function() {
      confirmPassword.style.color = 'gray';
    });

  //Đóng modal và ở lại trang đăng ký nếu người dùng nhấn vào dấu X hoặc ra ngoài modal
    document.querySelector('.close').addEventListener('click', function() {
        document.getElementById('successModal').style.display = 'none';
    });

    window.onclick = function(event) {
        const modal = document.getElementById('successModal');
        if (event.target == modal) {
            modal.style.display = 'none';
        }
    }

    // Chuyển hướng đến trang đăng nhập khi nhấn nút OK
    document.getElementById('redirectBtn').addEventListener('click', function() {
        window.location.href = "{{ route('admin.login') }}";
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
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/feather.css') }}"> --}}
</body>
</html>