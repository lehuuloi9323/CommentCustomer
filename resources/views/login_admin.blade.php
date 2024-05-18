<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/style_login.css') }}"  type="text/css">

</head>

<body>
  <div class="wp">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="center-left">
            <h1 class="text-center">Login - Niso Admin</h1>
            <div class="mt-4">
              <form action="{{ route('login_admin_action') }}" method="POST">
                @csrf
              <input type="number" name="id" placeholder="Nhập id của bạn" style="width: 400px; height: 50px;" class="form-control rounded-pill">
              <div class="mx-2">
                @error('id')
                <small class="text-danger d-block">{{ $message }}</small>
                @enderror
              </div>
              <div class="mt-3 position-relative">
                <input type="password" id="password" name="password" class="form-control rounded-pill" placeholder="Nhập mật khẩu">
                <span id="togglePassword" class="eye-icon">
                    <i class="fas fa-eye"></i>
                </span>

            </div>
            <div class="mx-2">
                @error('password')
                <small class="text-danger d-block">{{ $message }}</small>
                @enderror
              </div>
              <div class="mt-3">
                <input type="submit" class="form-control rounded-pill"  value="Sign in" style="background-color: #A1A341; color: #fff; font-weight: bold;">
              </div>
              </form>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <img src="{{ asset('img/302439512_180557924486671_4224866286475051881_n.png') }}" alt="Logo" class="img-fluid bg-right">
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
  </script>
  <script>
    document.getElementById('togglePassword').addEventListener('click', function (e) {
    const passwordInput = document.getElementById('password');
    const icon = e.target;

    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        passwordInput.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
});

  </script>
</body>

</html>
