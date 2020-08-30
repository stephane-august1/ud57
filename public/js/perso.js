

document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('#calendrier');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          locale: 'fr',
          timeZone: 'Europe/Paris',
          headerToolbar: {
            start: 'prev,next today',
            center: 'title',
            end: 'dayGridMonth,timeGridWeek,timeGridDay',
          }
        });
        calendar.render();
      });


  