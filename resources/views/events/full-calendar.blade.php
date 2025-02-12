@extends('layouts.master')

@section('page-title')
    {{ __('admin.Events') }}
@endsection

@section('page-head')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- FullCalendar v6 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/main.min.css" />

@endsection

@section('page-content')
<div class="container">
    <div class="card mt-5">
        <h3 class="card-header p-3 text-center">{{__('admin.Event Calendar')}}</h3>
        <div class="card-body">
            <div id='calendar'></div>
        </div>
    </div>
</div>
@endsection

@section('page-scripts')

<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.15/index.global.js" integrity="sha512-3I+0zIxy2IkeeCvvhXUEu+AFT3zAGuHslHLDmM8JBv6FT7IW6WjhGpUZ55DyGXArYHD0NshixtmNUWJzt0K32w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.15/index.global.min.js" integrity="sha512-PneTXNl1XRcU6n5B1PGTDe3rBXY04Ht+Eddn/NESwvyc+uV903kiyuXCWgL/OfSUgnr8HLSGqotxe6L8/fOvwA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.15/index.min.js" integrity="sha512-xCMh+IX6X2jqIgak2DBvsP6DNPne/t52lMbAUJSjr3+trFn14zlaryZlBcXbHKw8SbrpS0n3zlqSVmZPITRDSQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/6.1.15/index.js" integrity="sha512-bBl4oHIOeYj6jgOLtaYQO99mCTSIb1HD0ImeXHZKqxDNC7UPWTywN2OQRp+uGi0kLurzgaA3fm4PX6e2Lnz9jQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $(document).ready(function () {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        editable: true,
        selectable: true,
        eventStartEditable: true,
        eventDurationEditable: true,
        droppable: true,
        
        // Fetch Events
        events: function(fetchInfo, successCallback, failureCallback) {
            $.ajax({
                url: "{{ route('events') }}",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    successCallback(response);
                },
                error: function(xhr, status, error) {
                    failureCallback(error);
                }
            });
        },

        // Add Event
        select: function(info) {
            var title = prompt("Enter Event Title:");
            if (title) {
                $.ajax({
                    url: "{{ route('events.ajax') }}",
                    type: "POST",
                    data: {
                        title: title,
                        start: info.startStr,
                        end: info.endStr,
                        type: "add",
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        toastr.success("Event Created Successfully"); 
                        calendar.refetchEvents(); 
                    },
                    error: function(xhr) {
                        toastr.error("Error adding event."); 
                    }
                });
            }
            calendar.unselect();
        },

        // Update Event (Drag & Drop)
        eventDrop: function(info) {
            var event = info.event;
            $.ajax({
                url: "{{ route('events.ajax') }}",
                type: "POST",
                data: {
                    id: event.id,
                    title: event.title,
                    start: event.start.toISOString(),
                    end: event.end ? event.end.toISOString() : null,
                    type: "update",
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    toastr.success("Event Updated Successfully");
                },
                error: function(xhr) {
                    toastr.error("Error Updating Event."); 
                }
            });
        },

        // Edit Event (Click)
        eventClick: function(info) {
            var newTitle = prompt("Update Event Title:", info.event.title);
            if (newTitle) {
                $.ajax({
                    url: "{{ route('events.ajax') }}",
                    type: "POST",
                    data: {
                        id: info.event.id,
                        title: newTitle,
                        start: info.event.start.toISOString(),
                        end: info.event.end ? info.event.end.toISOString() : null,
                        type: "update",
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        toastr.success("Event title updated successfully!");  // Toastr success notification
                        info.event.setProp("title", newTitle);
                    },
                    error: function(xhr) {
                        toastr.error("Error updating event title.");  // Toastr error notification
                    }
                });
            }
        },

        // Delete Event (Right-click)
        eventDidMount: function(info) {
            info.el.addEventListener("contextmenu", function (e) {
                e.preventDefault();
                if (confirm("Are you sure you want to delete this event?")) {
                    $.ajax({
                        url: "{{ route('events.ajax') }}",
                        type: "POST",
                        data: {
                            id: info.event.id,
                            type: "delete",
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            toastr.success("Event Deleted Successfully!"); 
                            info.event.remove(); 
                        },
                        error: function(xhr) {
                            toastr.error("Error Deleting Event.");
                        }
                    });
                }
            });
        }
    });

    calendar.render();
});

</script>
@endsection
