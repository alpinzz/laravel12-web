<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <title>Masuk</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Tema admin lengkap yang dapat digunakan untuk membangun CRM, CMS, dll." />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('frontend/assets/images/logo/logo_AR-removebg-preview.webp') }}">

    <!-- App css -->
    <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons -->
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <!-- Begin page -->
    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-8 col-lg-6 col-xl-5">
                <div class="card shadow">
                    <div class="card-body p-4 p-md-5">
                        <div class="text-center mb-4">
                            <a href="index.html" class="auth-logo">
                                <img src="{{ asset('frontend/assets/images/logo/logo_AR-removebg-preview.webp') }}"
                                    alt="logo-dark" class="mx-auto" height="45" />
                            </a>
                            <h4 class="mt-3">Selamat Datang</h4>
                            <p class="text-muted">Silakan masuk ke akun Anda</p>
                        </div>

                        <form method="POST" action="{{ route('login') }}">
                            @csrf


                            <div class="mb-3">
                                <label for="email" class="form-label">Username or Email</label>
                                <input class="form-control @error('login') is-invalid @enderror" type="text"
                                    id="email" name="login" value="{{ old('login') }}" autofocus
                                    @error('login')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                    </div>



                                {{-- <div class="mb-3">
                                <label for="role" class="form-label">Role</label>
                                <select class="form-control" name="role" id="role" onchange="toggleDivision()">
                                    <option value="admin">Admin</option>
                                    <option value="author">Author</option>
                                </select>
                            </div> --}}



                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select class="form-control @error('role') is-invalid @enderror" name="role"
                                        id="role" onchange="toggleDivision()">
                                        <option value="">Pilih Role</option>
                                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin
                                        </option>
                                        <option value="author" {{ old('role') == 'author' ? 'selected' : '' }}>Author
                                        </option>
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="mb-3" id="division-group" style="display: none;">
                                    <label for="division" class="form-label">Divisi</label>
                                    <select class="form-control @error('division') is-invalid @enderror" name="division"
                                        id="division">
                                        <option value="">Pilih Bidang</option>
                                        <option value="bph" {{ old('division') == 'bph' ? 'selected' : '' }}>BPH
                                        </option>
                                        <option value="organisasi"
                                            {{ old('division') == 'organisasi' ? 'selected' : '' }}>
                                            Bidang Organisasi</option>
                                        <option value="kader" {{ old('division') == 'kader' ? 'selected' : '' }}>
                                            Bidang
                                            Kader</option>
                                        <option value="hikmah" {{ old('division') == 'hikmah' ? 'selected' : '' }}>
                                            Bidang
                                            Hikmah</option>
                                        <option value="rpk" {{ old('division') == 'rpk' ? 'selected' : '' }}>Bidang
                                            RPK
                                        </option>
                                        <option value="olahraga" {{ old('division') == 'olahraga' ? 'selected' : '' }}>
                                            Bidang Olahraga dan Kepemudaan</option>
                                        <option value="medkom" {{ old('division') == 'medkom' ? 'selected' : '' }}>
                                            Bidang
                                            Medkom</option>
                                        <option value="tkk" {{ old('division') == 'tkk' ? 'selected' : '' }}>Bidang
                                            TKK
                                        </option>
                                    </select>
                                    @error('division')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>



                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                        name="password" id="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="mb-3 text-end">
                                    <a href="{{ route('password.request') }}" class="text-muted">Lupa password?</a>
                                </div>


                                <div class="d-grid mb-3">
                                    <button class="btn btn-primary" type="submit">Masuk</button>
                                </div>

                                <div class="text-center text-muted">
                                    <p class="mb-0">Belum punya akun? <a href="{{ route('register') }}"
                                            class="text-primary fw-medium">Daftar disini</a></p>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor -->
    <script src="{{ asset('backend/assets/libs/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/feather-icons/feather.min.js') }}"></script>

    <!-- App js-->
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


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
