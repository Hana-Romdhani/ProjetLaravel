@extends('backend.layouts.layoutdashbored')

@section('contentadmin')
<section class="container-fluid p-4">

    <form action="{{ isset($plantation) ? route('plantation.update', $plantation->id) : route('backend.plantation.formPlantation') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        @if(isset($plantation))
            @method('PUT')
        @endif

        <!-- Plantation Name -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="plantationName">Plantation Name</label>
            <input type="text" id="plantationName" name="nom" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom', $plantation->nom ?? '') }}" required />
            <div class="invalid-feedback">Please enter the name of the plantation.</div>
            @error('nom')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Select Gardener -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="gardener">Gardener</label>
            <select id="gardener" name="user_id" class="form-control @error('user_id') is-invalid @enderror" required>
                <option value="" disabled selected>Select a gardener</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ isset($plantation) && $plantation->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->nameUser }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">Please select a gardener.</div>
            @error('user_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Select Garden -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="garden">Garden</label>
            <select id="garden" name="jardin_id" class="form-control @error('jardin_id') is-invalid @enderror" required>
                <option value="" disabled selected>Select a garden</option>
                @foreach($jardins as $jardin)
                    <option value="{{ $jardin->id }}" {{ isset($plantation) && $plantation->jardin_id == $jardin->id ? 'selected' : '' }}>
                        {{ $jardin->name }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">Please select a garden.</div>
            @error('jardin_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Select Plants (Multiple Select) -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="plants">Plants</label>
            <select id="plants" name="plantes[]" class="form-control @error('plantes') is-invalid @enderror" multiple required>
                @foreach($plantes as $plante)
                    <option value="{{ $plante->id }}" {{ isset($plantation) && $plantation->plantes->contains($plante->id) ? 'selected' : '' }}>
                        {{ $plante->nom }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">Please select at least one plant.</div>
            @error('plantes')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
<!-- Plantation Date -->
<div class="mb-3 col-12 col-md-6">
    <label class="form-label" for="plantationDate">Date of Plantation</label>
    <input type="date" id="plantationDate" name="date_plantation" class="form-control @error('date_plantation') is-invalid @enderror" 
           value="{{ old('date_plantation', isset($plantation) ? $plantation->date_plantation->format('Y-m-d') : '') }}" required />
    <div class="invalid-feedback">Please provide the plantation date.</div>
    @error('date_plantation')
        <div class="text-danger">{{ $message }}</div>
    @enderror
</div>


        <!-- Submit Button -->
        <div class="col-12">
            <button class="btn btn-primary" type="submit">{{ isset($plantation) ? 'Update Plantation' : 'Create Plantation' }}</button>
        </div>
    </form>

</section>

<script>
    // JavaScript to activate Bootstrap validation
    (function () {
        'use strict';
        window.addEventListener('load', function () {
            var forms = document.getElementsByClassName('needs-validation');
            Array.prototype.filter.call(forms, function (form) {
                form.addEventListener('submit', function (event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

@endsection
