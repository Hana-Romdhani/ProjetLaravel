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

    <form action="{{ route('conseil.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <!-- Title Input -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="categorieconseilname">Conseil Title</label>
            <input type="text" id="categorieconseilname" name="titre"
                class="form-control @error('titre') is-invalid @enderror"
                value="{{ old('titre') }}" required>

            @error('titre')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
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
        <!-- Content Textarea -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="contenus">Contents</label>
            <textarea id="contenus" name="contenus" rows="4"
                class="form-control @error('contenus') is-invalid @enderror"
                required>{{ old('contenus') }}</textarea>

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
                placeholder="Enter User ID"> <!-- Placeholder for user guidance -->

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
                class="form-control @error('image_url') is-invalid @enderror" accept="image/*">

            @error('image_url')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>



        <!-- Video Upload -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="video_url">Video URL</label>
            <input type="url" id="video_url" name="video_url"
                class="form-control @error('video_url') is-invalid @enderror"
                placeholder="Enter video URL">

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
<!-- Include TinyMCE with your API key -->
<script src="https://cdn.tiny.cloud/1/{{ env('TINYMC_KEY') }}/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

<script>
  tinymce.init({
    selector: 'textarea',
    plugins: [

      'anchor', 'autolink', 'charmap', 'codesample', 'emotissssscons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
      'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
    ],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
      { value: 'First.Name', title: 'First Name' },
      { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
  });
</script>


@endsection
