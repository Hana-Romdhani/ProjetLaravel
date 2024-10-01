@extends('backend.layouts.layoutdashbored')
@section('contentadmin')

<div class="card-body d-flex flex-column gap-4">
    <div class="d-flex flex-column gap-2">
        <h4 class="mb-0">Category Creation for Conseil</h4>
        <div class="d-flex align-items-center">
            <img src="/assets/images/conseil/plante.png" alt="Image de la carte" class="img-fluid w-25 me-4">
            <p class="mb-0">
                Provide a brief overview of the category you are creating for the Conseil.<br>
                Describe its purpose and the type of advice or guidance that will be associated with this category.<br>
                Additionally, outline the intended audience for this category, and if applicable,
                 include links to relevant resources or reference materials.
            </p>
        </div>
    </div>
</div>



<section class="container-fluid p-4">

    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <form action="{{ route('conseil-categorie.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="categorieconseilname">Category Name</label>
            <input type="text" id="categorieconseilname" name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" required>

            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="col-12">
        <a href="{{ route('conseil-categorie.index') }}" class="btn btn-secondary">Back</a>
        <button class="btn btn-primary" type="submit">Create Categorie Conseil</button>
        </div>
    </form>

</section>
@endsection
