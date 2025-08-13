{{-- <x-homelayout>

    <div class="breadcrumb-wrapper light-bg">
        <div class="container">

            <div class="breadcrumb-content">
                <h1 class="breadcrumb-title pb-0">Kontak</h1>
                <div class="breadcrumb-menu-wrapper">
                    <div class="breadcrumb-menu-wrap">
                        <div class="breadcrumb-menu">
                            <ul>
                                <li><a href="/">Home</a></li>
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


    <div class="container my-5" style="max-width: 800px;">
        <div class="lonyo-contact-box box2 aos-init aos-animate" data-aos="fade-up" data-aos-duration="700">
            <h4>Fill the form below</h4>
            <form action="#">
                <div class="lonyo-main-field">
                    <p>Full name*</p>
                    <input type="text" placeholder="Enter your name">
                </div>
                <div class="lonyo-main-field">
                    <p>Email address*</p>
                    <input type="email" placeholder="Your email address">
                </div>
                <p>Message</p>
                <div class="lonyo-main-field-textarea">
                    <textarea class="button-text" name="textarea" placeholder="Write your message here..."></textarea>
                </div>
                <button class="lonyo-default-btn extra-btn d-block" type="button">Send your message</button>
            </form>
        </div>
    </div>


</x-homelayout> --}}


<x-homelayout>

    <!-- Hero Section -->
    <section class="bg-light py-5">
        <div class="container py-4">
            <div class="row justify-content-center text-center">
                <div class="col-lg-8">
                    <h1 class="display-5 fw-bold mb-3">Hubungi Kami</h1>
                    <p class="lead text-muted">Kami siap membantu Anda. Silakan isi formulir di bawah ini atau gunakan
                        informasi kontak yang tersedia.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <nav class="bg-white py-3 border-bottom">
        <div class="container">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/" class="text-decoration-none">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Kontak</li>
            </ol>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <div class="row g-4">
            <!-- Contact Form -->
            <div class="col-lg-7">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4 p-md-5">
                        <h2 class="h4 fw-bold mb-4">Formulir Kontak</h2>
                        <form>
                            <div class="mb-3">
                                <label for="fullName" class="form-label">Nama Lengkap*</label>
                                <input type="text" class="form-control" id="fullName"
                                    placeholder="Masukkan nama Anda" required>
                            </div>

                            <div class="mb-3">
                                <label for="emailAddress" class="form-label">Alamat Email*</label>
                                <input type="email" class="form-control" id="emailAddress"
                                    placeholder="Alamat email Anda" required>
                            </div>

                            <div class="mb-3">
                                <label for="message" class="form-label">Pesan*</label>
                                <textarea class="form-control" id="message" rows="5" placeholder="Tulis pesan Anda di sini..." required></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 py-2 mt-2">
                                Kirim Pesan
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-5">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4 p-md-5">
                        <h2 class="h4 fw-bold mb-4">Informasi Kontak</h2>

                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded me-3">
                                <i class="bi bi-geo-alt-fill text-primary fs-4"></i>
                            </div>
                            <div>
                                <h3 class="h6 fw-bold mb-1">Alamat</h3>
                                <p class="mb-0 text-muted">Jl. Contoh No. 123<br>Jakarta Selatan, 12345</p>
                            </div>
                        </div>

                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded me-3">
                                <i class="bi bi-telephone-fill text-primary fs-4"></i>
                            </div>
                            <div>
                                <h3 class="h6 fw-bold mb-1">Telepon</h3>
                                <p class="mb-0 text-muted">+62 21 1234 5678</p>
                                <p class="mb-0 text-muted">+62 812 3456 7890</p>
                            </div>
                        </div>

                        <div class="d-flex mb-4">
                            <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded me-3">
                                <i class="bi bi-envelope-fill text-primary fs-4"></i>
                            </div>
                            <div>
                                <h3 class="h6 fw-bold mb-1">Email</h3>
                                <p class="mb-0 text-muted">info@perusahaan.com</p>
                                <p class="mb-0 text-muted">support@perusahaan.com</p>
                            </div>
                        </div>

                        <div class="d-flex">
                            <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded me-3">
                                <i class="bi bi-clock-fill text-primary fs-4"></i>
                            </div>
                            <div>
                                <h3 class="h6 fw-bold mb-1">Jam Operasional</h3>
                                <p class="mb-0 text-muted">Senin-Jumat: 08.00 - 17.00</p>
                                <p class="mb-0 text-muted">Sabtu: 08.00 - 12.00</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="container mb-5">
        <div class="card border-0 shadow-sm">
            <div class="card-body p-0">
                <div class="ratio ratio-16x9">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.8195613506864!3d-6.194741395493371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f5390917b759%3A0x6b45e839560ef85!2sMonumen%20Nasional!5e0!3m2!1sen!2sid!4v1629997977897!5m2!1sen!2sid"
                        allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        .card {
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .breadcrumb {
            padding: 0.75rem 1rem;
            background-color: transparent;
        }
    </style> --}}

</x-homelayout>
