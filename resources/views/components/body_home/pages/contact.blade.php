<x-homelayout>

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


</x-homelayout>
