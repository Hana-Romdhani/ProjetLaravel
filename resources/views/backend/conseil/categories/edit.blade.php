@extends('backend.layouts.layoutdashbored')
@section('contentadmin')
<section class="container-fluid p-4">

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categorie.update', $categorie_conseil->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="categorieconseilname">Category Name</label>
            <input type="text" id="categorieconseilname" name="name" class="form-control" value="{{ $categorie_conseil->name ?? '' }}" placeholder="Create a category for your advice" required />
            <div class="invalid-feedback">Please enter the name of the category.</div>
        </div>

        <!-- Submit Button -->
        <div class="col-12">
            <button class="btn btn-primary" type="submit">Update Categorie Conseil</button>
        </div>
    </form>

</section>
@endsection
