<div>
    <div>
        <div id='calendar-container' wire:ignore>
            <div id='calendar'></div>
        </div>
    </div>
    @push('scripts')
        <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.js'></script>

        <script>
            document.addEventListener('livewire:load', function() {
                var Calendar = FullCalendar.Calendar;
                var Draggable = FullCalendar.Draggable;
                var calendarEl = document.getElementById('calendar');
                var checkbox = document.getElementById('drop-remove');
                
                var calendar = new Calendar(calendarEl, {
                    events:  [],
                    dateClick(info) {
                        var client = prompt('Tapez le nom du client');
                        var date = new Date(info.dateStr + 'T00:00:00');
                        var personne = prompt('Tapez le nom du personne');
                        if (client != null && client != '') {
                            calendar.addEvent({
                                title: client,
                                start: date,
                                personne: personne,
                                allDay: true
                            });
                            var eventAdd={
                                client: client,
                                date: date,
                                personne: personne
                            };
                            @this.addevent(eventAdd);
                            alert('OK, c\'est bon');
                        } else {
                            alert('Refusé');
                        }
                    },
                    eventClick(info) {
    if (info.event.title) {
        // Récupérer l'ID de l'intervention depuis l'événement
        var interventionId = info.event.id;
        // Rediriger vers la route interventions.show avec l'ID de l'intervention
        window.location.href = '{{ route("interventions.edit", ":interventionId") }}'.replace(':interventionId', interventionId);
    }
}
,
                    editable: true,
                    selectable: true,
                    displayEventTime: false,
                    droppable: true,
                    drop: function(info) {
                        if (checkbox.checked) {
                            info.draggedEl.parentNode.removeChild(info.draggedEl);
                        }
                    },
                    eventDrop: function(info) {
                        @this.eventDrop(info.event);
                    },   
                     loading: function(isLoading) {
                        if (!isLoading) {
                            // Charger les interventions depuis Livewire
                            @this.loadInterventions().then(data => {
                                var events = JSON.parse(data);
                                calendar.removeAllEvents(); // Supprimer tous les événements existants
                                calendar.addEventSource(events); // Ajouter les nouveaux événements
                            });
                        }
                    }
                });
                calendar.render();
                Livewire.on('refreshCalendar', () => {
                    calendar.refetchEvents();
                });
            });
        </script>
        <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.3.1/main.min.css' rel='stylesheet' />
    @endpush
</div>
