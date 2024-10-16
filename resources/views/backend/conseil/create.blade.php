@extends('backend.layouts.layoutdashbored')
@section('contentadmin')

<div class="card-body d-flex flex-column gap-4 center ">
    <div class="d-flex flex-column gap-2">
        <h4 class="mb-0"> Creation de Conseil</h4>
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

<section class="container-fluid p-4  ">

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

    <form id="save-content-form" action="{{ route('conseil.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <!-- Title Input -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="categorieconseilname">Conseil Title</label>
            <input type="text" id="categorieconseilname" name="titre"
                class="form-control @error('titre') is-invalid @enderror"
                value="{{ old('titre') }}" required>
            <!-- Add this div for the error message -->
            <div class="invalid-feedback">
        @error('titre') {{ $message }} @enderror
    </div>
        </div>


        <!-- Question Input -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="question">Question</label>
            <input type="text" id="question" name="question"
                class="form-control @error('question') is-invalid @enderror"
                value="{{ old('question') }}" required>

            @error('question')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!-- Content Textarea (TinyMCE) -->
        <!-- Content Textarea (TinyMCE) -->
        <div class="mb-3 col-12 col-md-6">
            <label for="contenus" class="form-label">Contenus</label>
            <textarea class="form-control @error('contenus') is-invalid @enderror" id="tinymce" name="contenus">{{ old('contenus') }}</textarea>
            @error('contenus')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>



        <!-- User ID Input -->
        <!-- User ID Input -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="user_id">User ID</label>
            <input type="number" id="user_id" name="user_id"
                class="form-control @error('user_id') is-invalid @enderror"
                value="{{ old('user_id') }}" required
                min="1"
                step="1"
                placeholder="Enter User ID" /> <!-- Placeholder for user guidance -->

            @error('user_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>


        <!-- Category ID Input -->
        <!-- Category ID Input -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="category_id">Category</label>
            <select id="category_id" name="category_id"
                class="form-control @error('category_id') is-invalid @enderror" required>
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
                @endforeach
            </select>

            @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>




        <!-- Image Upload -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="image_url">Image URL</label>
            <input type="file" id="image_url" name="image_url"
                class="form-control @error('image_url') is-invalid @enderror" accept="image/*" />

            @error('image_url')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>



        <!-- Video Upload -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="video_url">Video URL</label>
            <input type="url" id="video_url" name="video_url"
                class="form-control @error('video_url') is-invalid @enderror"
                placeholder="Enter video URL" />

            @error('video_url')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>


        <!-- Submit Button -->
        <div class="col-12">
            <a href="{{ route('conseil.index') }}" class="btn btn-secondary">Back</a>
            <button class="btn btn-primary" type="submit">Create Conseil</button>
        </div>
    </form>

</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.tiny.cloud/1/{{ env('TINYMC_KEY') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script type="text/javascript">
    tinymce.init({
        selector: 'textarea#tinymce',
        height: 600
    });

    $(document).ready(function() {
        var formId = '#save-content-form';

        $(formId).on('submit', function(e) {
            e.preventDefault(); // Prevent form submission to handle via AJAX

            var data = new FormData(this); // Use FormData to handle file uploads

            // Add TinyMCE content to the form data
            data.append('contenus', tinyMCE.get('tinymce').getContent());

            // Clear any previous validation errors
            clearErrors();

            $.ajax({
                type: 'POST',
                url: $(formId).attr('action'),
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    // Only redirect if the response is successful (no validation errors)
                    if (response.success) {
                        window.location = "{{ route('conseil.index') }}"; // Redirect on success
                    } else {
                        // Handle validation errors returned from the server (if any)
                        if (response.errors) {
                            displayErrors(response.errors);
                        }
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                    if (xhr.status === 422) { // Laravel validation error status code
                        var errors = xhr.responseJSON.errors;
                        displayErrors(errors);
                    } else {
                        console.error('Error occurred:', xhr, textStatus, errorThrown);
                    }
                }
            });
        });

        // Function to clear previous validation error messages
        function clearErrors() {
    $('.is-invalid').removeClass('is-invalid');
    $('.invalid-feedback').text('');  // Clear all feedback messages
}

        // Function to display validation errors
        function displayErrors(errors) {
    for (var field in errors) {
        var errorMessage = errors[field][0];
        var inputElement = $('[name=' + field + ']');

        // Add 'is-invalid' class to the input field
        inputElement.addClass('is-invalid');

        // Find the next '.invalid-feedback' element and add the error message
        inputElement.next('.invalid-feedback').text(errorMessage);
    }
}

    });
</script>




@endsection
