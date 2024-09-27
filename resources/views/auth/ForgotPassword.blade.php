@extends('auth.layout')
@section('content')
<section class="container d-flex flex-column vh-100">
    <div class="row align-items-center justify-content-center g-0 h-lg-100 py-8">
        <div class="col-lg-5 col-md-8 py-8 py-xl-0">
            <!-- Card -->
            <div class="card shadow">
                <!-- Card body -->
                <div class="card-body p-6 d-flex flex-column gap-4">
                    <div>
                        <a href="../index.html">
                            <div class="d-flex justify-content-center mb-0">
                                <img src="../assets/images/brand/logo/icons8-protea-flower-64.png" class="d-inline" alt="logo-icon" />
                                <h1 class="mb-12 fw-bold d-inline">
                                    <span class="mb-0 text-secondary">Green</span>
                                    <span class="mb-0 text-success">
                                        <span>Link</span>
                                    </span>

                                </h1>
                                <span class="fst-italic text-muted d-block"><i class="bi bi-hash text-success"></i>For a Green Life</span>

                            </div>
                        </a>
                        <div class="d-flex flex-column gap-1">
                            <h1 class="mb-0 fw-bold">Forgot Password</h1>
                            <p class="mb-0">Fill the form to reset your password.</p>
                        </div>
                    </div>
                    <!-- Form -->
                    <form class="needs-validation" novalidate>
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="forgetEmail" class="form-label">Email</label>
                            <input type="email" id="forgetEmail" class="form-control" name="forgetEmail" placeholder="Enter Your Email " required />
                            <div class="invalid-feedback">Please enter valid email.</div>
                        </div>
                        <!-- Button -->
                        <div class="mb-3 d-grid">
                            <button type="submit" class="btn btn-primary">Send Resest Link</button>
                        </div>
                        <span>
                            Return to
                            <a href="sign-in.html">sign in</a>
                        </span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- Scroll top -->

@endsection
