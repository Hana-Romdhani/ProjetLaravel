@extends('frontend.layouts.layoutfrontend')

@section('contentlandinpage')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<section class="py-lg-8 py-7">
    <div class="container my-lg-8">
        <div class="row">
            <div class="offset-md-2 col-md-8 col-12">
                <div class="mb-8">
                    <h1 class="display-3 fw-semibold mb-4">Découvrez nos ressources !</h1>
                </div>
            </div>
        </div>
        
        <!-- Display list of ressources -->
        <div class="row g-6">
            @if($ressources->isEmpty())
                <p class="text-center">No ressources available at the moment.</p>
            @else
                @foreach($ressources as $ressource)
                    <div class="col-md-6 mb-6">
                        <div class="img-overlay">
                            <div class="img-color">
                                @if($ressource->image)
                                    <img src="{{ asset('storage/' . $ressource->image) }}" alt="" class="img-fluid w-100" />
                                @else
                                    <img src="{{ asset('path/to/default/image.jpg') }}" alt="" class="img-fluid w-100"/>
                                @endif
                                <div class="caption">
                                <a href="#" class="btn btn-white" data-bs-toggle="modal" data-bs-target="#demanderRessourceModal" data-ressource-id="{{ $ressource->id }}" data-owner-id="{{ $ressource->owner }}">Demander Ressource</a>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="fw-semibold mb-1">Nom: {{ $ressource->nom }}</h3>
                                <span>Quantité: {{ $ressource->quantite }}</span>
                            </div>
                            <p>Libelle: {{ $ressource->libelle }}</p>
                            <p><span>👤</span> {{ $ressource->user ? $ressource->user->nameUser : 'Unknown' }}</p>
                            
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="demanderRessourceModal" tabindex="-1" aria-labelledby="demanderRessourceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="demanderRessourceModalLabel">Demander Ressource</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="demanderRessourceForm" method="POST" action="{{ route('frontend.ressources.RessourcesPartage.store') }}">
                    @csrf
                    <input type="hidden" name="ressource_id" id="ressource_id">
                    <input type="hidden" name="user_preteur_id" id="user_preteur_id">
                    <div class="mb-3">
                        <label for="quantite" class="form-label">Quantité</label>
                        <input type="number" class="form-control" name="quantite" id="quantite" required>
                    </div>
                    <div class="mb-3">
                        <label for="date_partage" class="form-label">Date de Partage</label>
                        <input type="date" class="form-control" name="date_partage" id="date_partage" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
   document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('demanderRessourceModal');
    
    modal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Button that triggered the modal
        const ressourceId = button.getAttribute('data-ressource-id');
        const ownerId = button.getAttribute('data-owner-id');

        // Log the values for debugging
        console.log('Ressource ID:', ressourceId);
        console.log('Owner ID:', ownerId);

        // Update the modal's content.
        const ressourceInput = modal.querySelector('#ressource_id');
        const ownerInput = modal.querySelector('#user_preteur_id');
        ressourceInput.value = ressourceId;
        ownerInput.value = ownerId;
    });

    // Form submission
    document.getElementById('demanderRessourceForm').addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        fetch('/ressources-partages/demande', { // Vérifiez que cela correspond à votre route POST
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}' // Inclure le token CSRF pour Laravel
            }
        })
        .then(response => response.json())
        .then(data => {
           
                $('#demanderRessourceModal').modal('hide');
                // Optionnel : rafraîchir la page ou la liste des ressources

            
        })
        .catch(error => {
            console.error('Erreur:', error);
        });
    });


    });
</script>

@endsection
