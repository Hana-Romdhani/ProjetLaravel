@component('mail::message')
# Nouvelle Plantation Ajoutée

Bonjour {{ $plantation->user->nameUser }},

Une nouvelle plantation a été ajoutée avec succès. Voici les détails :

- **Nom de la plantation** : {{ $plantation->nom }}
- **Date de plantation** : {{ $plantation->date_plantation->format('d M, Y') }}
- **Jardin** : {{ $plantation->jardin->name }}

Merci de vérifier la plantation dans le système.

@endcomponent
