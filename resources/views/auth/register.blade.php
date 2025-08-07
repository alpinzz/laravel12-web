<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Register page" />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
</head>

<body class="bg-white d-flex align-items-center justify-content-center" style="min-height: 100vh;">

    <div class="w-100" style="max-width: 400px;">


        <div class="card shadow border-0 p-4">

            <div class="text-center mb-4">
                <a href="/">
                    <img src="{{ asset('frontend/assets/images/logo/logo_AR-removebg-preview.webp') }}" alt="Logo"
                        height="40">
                </a>
            </div>

            <h4 class="text-center mb-4">Register</h4>


            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control" type="text" id="name" name="name" required
                        placeholder="Enter your name">
                </div>

                <div class="form-group mb-3">
                    <label for="emailaddress" class="form-label">Email address</label>
                    <input class="form-control" type="email" id="email" name="email" required
                        placeholder="Enter your email">
                </div>

                <div class="form-group mb-3">
                    <label for="role" class="form-label">Role</label>
                    <select class="form-control" name="role" id="role" onchange="toggleDivision()" required>
                        <option value="admin">Admin
                        </option>
                        <option value="author">Author</option>
                    </select>
                </div>

                <div class="form-group mb-3" id="division-group" style="display: none">
                    <label for="division_id" class="form-label">Divisi</label>
                    <select class="form-control" name="division_id" id="division_id">
                        <option value="">Pilih Bidang</option>
                        @foreach (\App\Models\Divisi::all() as $division)
                            <option value="{{ $division->slug }}">{{ $division->name }}</option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input class="form-control" type="password" name="password" id="password" required
                        placeholder="Enter your password">
                </div>

                <div class="form-group mb-4">
                    <label for="password_confirmation" class="form-label">Confirm Password</label>
                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation"
                        required placeholder="Confirm your password">
                </div>

                <div class="d-grid">
                    <button class="btn btn-primary" type="submit">Register</button>
                </div>
            </form>

            <div class="text-center text-muted mt-4">
                <p class="mb-0">Already have an account? <a class="text-primary fw-medium"
                        href="{{ route('login') }}">Sign in</a></p>
            </div>
        </div>
    </div>

    <!-- Vendor Scripts -->
    <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    <script>
        function toggleDivision() {
            const role = document.getElementById('role').value;
            const divisionGroup = document.getElementById('division-group');
            divisionGroup.style.display = (role === 'author') ? 'block' : 'none';
        }

        document.addEventListener("DOMContentLoaded", toggleDivision);
    </script>

</body>

</html>
