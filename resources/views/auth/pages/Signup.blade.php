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
                                    <i class="bi bi-hash text-success"></i>For a Green Life
                                </span>
                            </div>
                        </a>
                        <div class="d-flex flex-column gap-1">
                            <h1 class="mb-0 fw-bold text-center">Sign up</h1>
                            <span>
                                Already have an account?
                                <a href="{{ route('login') }}" class="ms-1 float-end">Sign in</a> <!-- Updated route for login -->
                            </span>
                        </div>
                    </div>
                    <!-- Form -->
                    <form class="needs-validation" method="POST" action="{{ route('register') }}" novalidate> <!-- Registration route -->
                        @csrf
                        <!-- Username -->
                        <div class="mb-3">
                            <label for="signUpName" class="form-label">User Name</label>
                            <input type="text" id="signUpName" class="form-control" name="nameUser" placeholder="User Name" value="{{ old('nameUser') }}" required />
                            <div class="invalid-feedback">Please enter a valid username.</div>
                            @error('nameUser')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="signUpEmail" class="form-label">Email</label>
                            <input type="email" id="signUpEmail" class="form-control" name="email" placeholder="Email address here" value="{{ old('email') }}" required />
                            <div class="invalid-feedback">Please enter a valid email.</div>
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="signUpPassword" class="form-label">Password</label>
                            <input type="password" id="signUpPassword" class="form-control" name="password" placeholder="**************" required />
                            <div class="invalid-feedback">Please enter a valid password.</div>
                            @error('password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Confirm Password -->
                        <div class="mb-3">
                            <label for="signUpPasswordConfirm" class="form-label">Confirm Password</label>
                            <input type="password" id="signUpPasswordConfirm" class="form-control" name="password_confirmation" placeholder="**************" required />
                            <div class="invalid-feedback">Please confirm your password.</div>
                        </div>


                          <!-- Role Selection -->
                          <div class="mb-3">
                            <label class="form-label">Role</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="roleUser" value="user" {{ old('role') == 'user' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="roleUser">User</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="role" id="roleEditor" value="editor" {{ old('role') == 'editor' ? 'checked' : '' }} required>
                                <label class="form-check-label" for="roleEditor">Editor</label>
                            </div>
                            <div class="invalid-feedback">Please select a role.</div>
                            @error('role')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Submit Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Create Free Account</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>

@endsection
