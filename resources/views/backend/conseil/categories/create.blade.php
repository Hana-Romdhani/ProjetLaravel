@extends('backend.layouts.layoutdashbored')
@section('contentadmin')
<section class="container-fluid p-4">

    <form  action="{{ route('categorie.store') }}"  method="POST"  enctype="multipart/form-data">
        @csrf

        @method('POST')

        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="categorieconseilname"></label>
            <input type="text" id="categorieconseilname" name="name" class="form-control" value="{{ $CategorieConseil->name ?? '' }}" required />
            <div class="invalid-feedback">Please enter the name of the jardin.</div>
        </div>


        <!-- Submit Button -->
        <div class="col-12">
            <button class="btn btn-primary" type="submit"> Create Jardin</button>
        </div>
    </form>

</section>
@endsection
