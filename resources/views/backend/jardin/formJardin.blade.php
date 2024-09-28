@extends('backend.layouts.layoutdashbored')
@section('contentadmin')
<section class="container-fluid p-4">

    <div class="col-lg-12 col-md-12 col-12">
        <!-- Card -->
        <div class="card">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0">Jardin Details</h3>
                <p class="mb-0">You have full control to manage your jardin details.</p>
            </div>
            <!-- Card body -->
            <div class="card-body">
                <div>
                    <!-- Form -->
                    <form class="row gx-3 needs-validation" novalidate>


                        <div class="d-lg-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center mb-4 mb-lg-0">
                                <img src="../assets/images/avatar/avatar-3.jpg" id="img-uploaded" class="avatar-xl rounded-circle" alt="avatar" />
                                <div class="ms-3">
                                    <h4 class="mb-0">Your avatar</h4>
                                    <p class="mb-0">PNG or JPG no bigger than 800px wide and tall.</p>
                                </div>
                            </div>
                            <div>
                                <a href="#" class="btn btn-outline-secondary btn-sm">Upload</a>
                                <a href="#" class="btn btn-outline-danger btn-sm">Delete</a>
                            </div>
                        </div>


                        <!-- Jardin Name -->
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label" for="jardinName">Jardin Name</label>
                            <input type="text" id="jardinName" name="jardinName" class="form-control" placeholder="Jardin Name" required />
                            <div class="invalid-feedback">Please enter the name of the jardin.</div>
                        </div>


                        <!-- Jardin Location -->
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label" for="jardinLocation">Location</label>
                            <input type="text" id="jardinLocation" name="jardinLocation" class="form-control" placeholder="Jardin Location" required />
                            <div class="invalid-feedback">Please enter the location of the jardin.</div>
                        </div>
                        <!-- Jardin Size -->
                        <div class="mb-3 col-12 col-md-6">
                            <label class="form-label" for="jardinSize">Size (in sq meters)</label>
                            <input type="number" id="jardinSize" name="jardinSize" class="form-control" placeholder="Jardin Size" required />
                            <div class="invalid-feedback">Please enter the size of the jardin.</div>
                        </div>
                        <!-- Jardin Description -->
                        <div class="mb-3 col-12">
                            <label class="form-label" for="jardinDescription">Description</label>
                            <textarea id="jardinDescription" name="jardinDescription" class="form-control" placeholder="Describe your jardin" rows="4" required></textarea>
                            <div class="invalid-feedback">Please provide a description of the jardin.</div>
                        </div>
                        <!-- Jardin Type -->
                        <!-- <div class="mb-3 col-12 col-md-6">
                            <label class="form-label" for="jardinType">Jardin Type</label>
                            <select class="form-select" id="jardinType" name="jardinType" required>
                                <option value="">Select Jardin Type</option>
                                <option value="1">Private</option>
                                <option value="2">Community</option>
                                <option value="3">Public</option>
                            </select>
                            <div class="invalid-feedback">Please choose the jardin type.</div>
                        </div>
                        Country -->

                        <div class="col-12">
                            <!-- Button -->
                            <button class="btn btn-primary" type="submit">Update Jardin</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</section>
@endsection
