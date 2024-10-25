@extends('backend.layouts.layoutdashbored')

@section('contentadmin')
<!-- Include FullCalendar CSS -->
<link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />

<section class="container-fluid p-4">
    <div class="col-lg-12 col-md-12 col-12">
        <h1 class="h2 fw-bold">Your Plantation Agenda</h1>
        <!-- Directly use plantation events JSON -->
        <div id='calendar' data-plantations="{{ $plantationEvents }}"></div>
    </div>
</section>

<!-- Include FullCalendar JS -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        // Retrieve plantation data
        var plantationsData = JSON.parse(calendarEl.getAttribute('data-plantations'));

        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: plantationsData,
            eventClick: function(info) {
                alert(info.event.extendedProps.description);
            }
        });

        calendar.render();
    });
</script>
@endsection
