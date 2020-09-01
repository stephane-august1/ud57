console.log('test',test)
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
      
      
      },
      
    dayMaxEventRows : 4,
    dayMaxEvents : true,
    dayPopoverFormat: {month: 'long', day: 'numeric', year: 'numeric'},
   
    events:  test,
   
            
    editable: true,
    eventResizableFromStart: true,
  

  });
   calendar.on('eventChange',(e) =>{
        console.log(e);
          console.log('2emlog',e.event._def.extendedProps.description);
       let url = `/calendar/${e.event.id}/editevent`
       let donnees = {
           "id":e.event.id,
            "title": e.event.title,
            "description": e.event._def.extendedProps.description,
            "start":e.event.start,
            "fin":e.event.end,
            "textColor": e.event._def.ui.textColor,
            "backgroundColor": e.event._def.ui.backgroundColor,
            "borderColor": e.event._def.ui.borderColor,
            "allDay":e.event.allDay
         
       }
       let xhr = new XMLHttpRequest

       xhr.open("PUT",url)
       xhr.send(JSON.stringify(donnees))
       
    }),
   //event au click ouverture modal
       calendar.on('eventClick',(ev, jsEvent, view) => {
      
           var eventobj = ev;
    
           //console.log(ev);
           jQuery.noConflict(); 
           let url = `/calendar/${ev.event.id}/edit`;
           
        $('#hrefid').attr('href',url);
        $('#modalTitle').html(ev.event.title);
           $('#modalBody').html(ev.event._def.extendedProps.description);
           $("#start").html(ev.event.start)
            $("#fin").html(ev.event.end)
        $('#idedit').html(ev.event.id);
        $('#exampleModal').modal('show')
        
        
    }),
   
 
        calendar.render();
  });