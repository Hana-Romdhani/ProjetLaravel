@extends('auth.layouts.layoutauth')
@section('content')

<section class="container d-flex flex-column vh-100">
    <div class="row align-items-center justify-content-center g-0 h-lg-100 py-8">
        <div class="col-lg-5 col-md-8 py-8 py-xl-0">
            <!-- Card -->
            <div class="card shadow">
                <!-- Card body -->
                <div class="card-body p-6 d-flex flex-column gap-4">
                    <div>
                        <a href="{{ url('/') }}">
                            <div class="d-flex justify-content-center mb-0">
                                <img src="{{ asset('assets/images/brand/logo/icons8-protea-flower-64.png') }}" class="d-inline" alt="logo-icon" />
                                <h1 class="mb-12 fw-bold d-inline">
                                    <span class="mb-0 text-secondary">Green</span>
                                    <span class="mb-0 text-success">Link</span>
                                </h1>
                                <span class="fst-italic text-muted d-block">
                                    <i class="bi bi-hash text-success"></i>For a Green Life</span>
                            </div>
                        </a>
                        <div class="d-flex flex-column gap-1">
                            <h1 class="mb-0 fw-bold text-center ">Sign in</h1>
                            <span>
                                Don’t have an account?
                                <a href="{{ route('register') }}" class="ms-1">Sign up</a> <!-- Register route -->
                            </span>
                        </div>
                    </div>
                    <!-- Form -->
                    <form method="POST" action="{{ route('login.store') }}" novalidate> <!-- Point to login store route -->
                        @csrf
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="signInEmail" class="form-label">Username or email</label>
                            <input type="email" id="signInEmail" class="form-control" name="email" placeholder="Email address here" value="{{ old('email') }}" required />
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label for="signInPassword" class="form-label">Password</label>
                            <input type="password" id="signInPassword" class="form-control" name="password" placeholder="**************" required />
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Sign in</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
