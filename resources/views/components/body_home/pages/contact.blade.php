<x-homelayout>

    <div class="breadcrumb-wrapper light-bg mb-5">
        <div class="container">

            <div class="breadcrumb-content">
                <h1 class="breadcrumb-title pb-0">Kontak</h1>
                <div class="breadcrumb-menu-wrapper">
                    <div class="breadcrumb-menu-wrap">
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="{{ route('index') }}">Home</a></li>
                                <li><img src="{{ asset('frontend/assets/images/blog/right-arrow.svg') }}"
                                        alt="right-arrow"></li>
                                <li aria-current="page">Kontak</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!-- Main Content - Centered Form Only -->
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-xl-6">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <h2 class="h4 fw-bold mb-4 text-center">Formulir Kontak</h2>
                        <form action="{{ route('contact.message') }}" method="POST">
                            @csrf


                            <div class="mb-3">
                                <label for="fullName" class="form-label">Nama Lengkap*</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Masukkan nama Anda" required autocomplete="off">
                            </div>

                            <div class="mb-3">
                                <label for="emailAddress" class="form-label">Alamat Email*</label>
                                <input type="email" class="form-control" name="email" id="email"
                                    autocomplete="off" placeholder="Alamat email Anda" required>
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Pesan*</label>
                                <textarea class="form-control" name="message" id="message" rows="5" placeholder="Tulis pesan Anda di sini..."
                                    required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 mt-2">
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-homelayout>
