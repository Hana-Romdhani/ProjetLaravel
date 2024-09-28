@extends('backend.layouts.layoutdashbored')
@section('contentadmin')
<section class="container-fluid p-4">



        <div class="col-lg-36 col-md-46 col-46">
            <!-- Card -->
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <h3 class="mb-0">Profile Details</h3>
                    <p class="mb-0">You have full control to manage your own account setting.</p>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <div class="d-lg-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center mb-4 mb-lg-0">
                            <img src="../assets/images/avatar/avatar-3.jpg" id="img-uploaded" class="avatar-xl rounded-circle" alt="avatar" />
                            <div class="ms-3">
                                <h4 class="mb-0">Your avatar</h4>
                                <p class="mb-0">PNG or JPG no bigger than 800px wide and tall.</p>
                            </div>
                        </div>
                        <div>
                            <a href="#" class="btn btn-outline-secondary btn-sm">Update</a>
                            <a href="#" class="btn btn-outline-danger btn-sm">Delete</a>
                        </div>
                    </div>
                    <hr class="my-5" />
                    <div>
                        <h4 class="mb-0">Personal Details</h4>
                        <p class="mb-4">Edit your personal information and address.</p>
                        <!-- Form -->
                        <form class="row gx-3 needs-validation" novalidate>
                            <!-- First name -->
                            <div class="mb-3 col-12 col-md-6">
                                <label class="form-label" for="profileEditFname">First Name</label>
                                <input type="text" id="profileEditFname" name="profileEditFname" class="form-control" placeholder="First Name" required />
                                <div class="invalid-feedback">Please enter first name.</div>
                            </div>
                            <!-- Last name -->
                            <div class="mb-3 col-12 col-md-6">
                                <label class="form-label" for="profileEditLname">Last Name</label>
                                <input type="text" id="profileEditLname" name="profileEditLname" class="form-control" placeholder="Last Name" required />
                                <div class="invalid-feedback">Please enter last name.</div>
                            </div>
                            <!-- Phone -->
                            <div class="mb-3 col-12 col-md-6">
                                <label class="form-label" for="profileEditPhone">Phone</label>
                                <input type="text" id="profileEditPhone" name="profileEditPhone" class="form-control" placeholder="Phone" required />
                                <div class="invalid-feedback">Please enter phone number.</div>
                            </div>
                            <!-- Birthday -->
                            <div class="mb-3 col-12 col-md-6">
                                <label class="form-label" for="profileEditBirth">Birthday</label>
                                <input class="form-control flatpickr" type="text" placeholder="Birth of Date" id="profileEditBirth" name="profileEditBirth" />
                                <div class="invalid-feedback">Please choose a date.</div>
                            </div>
                            <!-- Address -->
                            <div class="mb-3 col-12 col-md-6">
                                <label class="form-label" for="profileEditAddress1">Address Line 1</label>
                                <input type="text" id="profileEditAddress1" name="profileEditAddress1" class="form-control" placeholder="Address" required />
                                <div class="invalid-feedback">Please enter address.</div>
                            </div>
                            <!-- Address -->
                            <div class="mb-3 col-12 col-md-6">
                                <label class="form-label" for="profileEditAddress2">Address Line 2</label>
                                <input type="text" id="profileEditAddress2" name="profileEditAddress2" class="form-control" placeholder="Address" required />
                                <div class="invalid-feedback">Please enter address.</div>
                            </div>
                            <!-- State -->
                            <div class="mb-3 col-12 col-md-6">
                                <label class="form-label" for="profileEditState">State</label>
                                <select class="form-select" data-choices="" id="profileEditState" name="profileEditState" required>
                                    <option value="">Select State</option>
                                    <option value="1">Gujarat</option>
                                    <option value="2">Rajasthan</option>
                                    <option value="3">Maharashtra</option>
                                </select>
                                <div class="invalid-feedback">Please choose state.</div>
                            </div>
                            <!-- Country -->
                            <div class="mb-3 col-12 col-md-6">
                                <label class="form-label" for="editCountry">Country</label>
                                <select class="form-select" data-choices="" id="editCountry" required>
                                    <option value="">Select Country</option>
                                    <option value="1">India</option>
                                    <option value="2">UK</option>
                                    <option value="3">USA</option>
                                </select>
                                <div class="invalid-feedback">Please choose country.</div>
                            </div>
                            <div class="col-12">
                                <!-- Button -->
                                <button class="btn btn-primary" type="submit">Update Profile</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

</section>
@endsection
