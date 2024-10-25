@extends('backend.layouts.layoutdashbored')
@section('contentadmin')
<section class="container-fluid p-4">

    <form action="{{ isset($plantation) ? route('plantation.update', $plantation->id) : route('backend.plantation.formPlantation') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($plantation))
        @method('PUT')
        @endif

        <!-- Plantation Name -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="plantationName">Plantation Name</label>
            <input type="text" id="plantationName" name="nom" class="form-control" value="{{ $plantation->nom ?? '' }}" required />
            <div class="invalid-feedback">Please enter the name of the plantation.</div>
        </div>

        <!-- Select Gardener -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="gardener">Gardener</label>
            <select id="gardener" name="user_id" class="form-control" required>
                <option value="" disabled selected>Select a gardener</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ isset($plantation) && $plantation->user_id == $user->id ? 'selected' : '' }}>
                        {{ $user->nameUser }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">Please select a gardener.</div>
        </div>

        <!-- Select Garden -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="garden">Garden</label>
            <select id="garden" name="jardin_id" class="form-control" required>
                <option value="" disabled selected>Select a garden</option>
                @foreach($jardins as $jardin)
                    <option value="{{ $jardin->id }}" {{ isset($plantation) && $plantation->jardin_id == $jardin->id ? 'selected' : '' }}>
                        {{ $jardin->name }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">Please select a garden.</div>
        </div>

        <!-- Select Plants (Multiple Select) -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="plants">Plants</label>
            <select id="plants" name="plantes[]" class="form-control" multiple required>
                @foreach($plantes as $plante)
                    <option value="{{ $plante->id }}" {{ isset($plantation) && $plantation->plantes->contains($plante->id) ? 'selected' : '' }}>
                        {{ $plante->nom }}
                    </option>
                @endforeach
            </select>
            <div class="invalid-feedback">Please select at least one plant.</div>
        </div>

        <!-- Plantation Date -->
        <div class="mb-3 col-12 col-md-6">
            <label class="form-label" for="plantationDate">Date of Plantation</label>
            <input type="date" id="plantationDate" name="date_plantation" class="form-control" value="{{ $plantation->date_plantation ?? '' }}" required />
            <div class="invalid-feedback">Please provide the plantation date.</div>
        </div>

        <!-- Submit Button -->
        <div class="col-12">
            <button class="btn btn-primary" type="submit">{{ isset($plantation) ? 'Update Plantation' : 'Create Plantation' }}</button>
        </div>
    </form>

</section>
@endsection
