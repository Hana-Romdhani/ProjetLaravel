@extends('backend.layouts.layoutdashbored')

@section('contentadmin')
<div class="card-body d-flex flex-column gap-4">
    <div class="d-flex flex-column gap-2">
        <h4 class="mb-0">Creation de Conseil</h4>
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

    <form action="{{ route('conseil.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')

        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="categorieconseilname">Conseil Name</label>
            <input type="text" id="categorieconseilname" name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name') }}" required>

            @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Question and Contents Section -->
        <section id="questions-container" class="mb-4">

            <div class="row" id="questions-wrapper">
                <div class="col-12 question-group mb-3">
                    <label class="form-label" for="question">Question</label>
                    <input type="text" name="questions[]" class="form-control @error('questions.*') is-invalid @enderror" required>

                    @error('questions.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror

                    <label class="form-label mt-2" for="contenus">Contents</label>
                    <textarea name="contents[]" rows="4" class="form-control @error('contents.*') is-invalid @enderror" required></textarea>

                    @error('contents.*')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <button type="button" class="btn btn-secondary" id="add-question-btn">Add Another Question</button>
        </section>

        <!-- Category ID Input -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="category_id">Category ID</label>
            <input type="number" id="category_id" name="category_id"
                class="form-control @error('category_id') is-invalid @enderror"
                value="{{ old('category_id', 1) }}" required disabled>

            <input type="hidden" name="category_id" value="1"> <!-- Hidden input for submission -->

            @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- User ID Input -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="user_id">User ID</label>
            <input type="number" id="user_id" name="user_id"
                class="form-control @error('user_id') is-invalid @enderror"
                value="{{ old('user_id', 1) }}" required disabled>

            <input type="hidden" name="user_id" value="1"> 

            @error('user_id')
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

<script>
    document.getElementById('add-question-btn').addEventListener('click', function() {
        const questionsWrapper = document.getElementById('questions-wrapper');

        // Create a new div for the new question group
        const newQuestionGroup = document.createElement('div');
        newQuestionGroup.classList.add('col-12', 'question-group', 'mb-3');

        // Create the question input
        const questionInput = document.createElement('input');
        questionInput.type = 'text';
        questionInput.name = 'questions[]';
        questionInput.className = 'form-control';
        questionInput.required = true;
        questionInput.placeholder = 'Question';

        // Create the contents textarea
        const contentsTextarea = document.createElement('textarea');
        contentsTextarea.name = 'contents[]';
        contentsTextarea.rows = 4;
        contentsTextarea.className = 'form-control';
        contentsTextarea.required = true;
        contentsTextarea.placeholder = 'Contents';

        // Append the inputs to the new question group
        newQuestionGroup.appendChild(document.createElement('label')).innerText = ' Another block';
        newQuestionGroup.appendChild(questionInput);
        newQuestionGroup.appendChild(document.createElement('label')).innerText = '';
        newQuestionGroup.appendChild(contentsTextarea);

        // Append the new question group to the wrapper
        questionsWrapper.appendChild(newQuestionGroup);
    });
</script>

@endsection
