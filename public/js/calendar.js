console.log('test', test[0].description)

 
document.addEventListener('DOMContentLoaded', function () {
      
 
  var calendarEl = document.getElementById('#calendrier');
  
  var calendar = new FullCalendar.Calendar(calendarEl, {
    
    initialView: 'dayGridMonth',
    locale: 'fr',
    buttonText: {
      today: 'Aujourd\'hui',
      month: 'Mois',
      week: 'Semaine',
      day: 'Jour',
      list: 'Liste'
    },
    timeZone: 'Europe/Paris',
    headerToolbar: {
      start: 'prev,next today',
      center: 'title',
      end: 'dayGridMonth,timeGridWeek,timeGridDay,list',
  
      
    },
      
    dayMaxEventRows: 4,
    dayMaxEvents: true,
    dayPopoverFormat: { month: 'long', day: 'numeric', year: 'numeric' },
 
    events: test,
  
    
            
    editable: true,
    eventResizableFromStart: true,
   

  });
  //recuperer la liste d"events
  /*
  var tet = calendar.getEvents();
  console.log('tet', tet);
  for (let i = 0; i < tet.length; i++) {
    const element = tet[i];
    
  console.log('titre : ', tet[i].title);
  console.log('description: ', tet[i]._def.extendedProps.description);
}*/
  
  calendar.on('eventMouseEnter', (e, ev) => {
  //on récupère le id de l event
      // console.log('id', e.event.id)
      var id = e.event.id;
  //on récupère les données de  l event avec le id
      var tet = calendar.getEventById(id);
        console.log('tet', tet);
    
  console.log('titre : ', tet.title);
  console.log('description: ', tet._def.extendedProps.description);

   //transformation  de la date
      function format(d) {
          //récuperation de l'heure
           var hours = d.getHours();
           //mise à l'heure francaise -Heures
           hours = (hours - 2);
           var minutes = d.getMinutes();
           if (minutes === 0) {
             minutes = minutes + '0';
             var time = hours + ':' + minutes;
           }
           else {
             minutes = minutes
           
           var time = hours + ':' + minutes;
         }
      // console.log('time',time);
    return (time); 
           } (new Date());
           const mydatestart = new Date(e.event.start);
           const mydatestop = new Date(e.event.end);
           my_time_formatstart = format(mydatestart);
            my_time_formatstop = format(mydatestop);
        
   // console.log('desc', e.event._def.extendedProps.description);
   
  //recupération des infos
    $('#tooltip').html('De '+my_time_formatstart+' à '+my_time_formatstop+ '<br><span style="color:rgb(90, 18, 18);"> à '+e.event.title+'</span><br><span style="color:rgb(255, 60, 60);"> '+e.event._def.extendedProps.description+'</span>');
    
    $('#tooltip').css({"display": "inline-block","margin-left":"40%"} );

  })

   calendar.on('eventMouseLeave', (e, ev) => {
    //enleve le tooltip 
    $('#tooltip').css('display','none');

  })
 
   calendar.on('eventChange',(e,view) =>{
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
            "backgroundColor": e.event.backgroundColor,
            "borderColor": e.event._def.ui.borderColor,
            "allDay":e.event.allDay
         
       }
     
       let xhr = new XMLHttpRequest

       xhr.open("PUT",url)
       xhr.send(JSON.stringify(donnees))
       
    }),
   //event au click ouverture modal
       calendar.on('eventClick',(ev, jsEvent, view) => {
       $('#tooltip').css('display','none');
           var eventobj = ev;
           
   
           

         function format(d) {
           dd = d.toUTCString();
           var month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
           var date = d.getDate() + " " + month[d.getMonth()] + ", " + d.getFullYear();
         //  var time = d.toTimeString().toLowerCase();
           // var newt = d;
           var hours = d.getHours();
           //mise a l'heure francaise -Heures
           hours = (hours - 2);
           var minutes = d.getMinutes();
           if (minutes === 0) {
             minutes = minutes + '0';
             var time = hours + ':' + minutes;
           }
           else {
             minutes = minutes
           
           var time = hours + ':' + minutes;
         }
       console.log('time',time);
    return (date + " à " + time); 
           } (new Date());
           const mydatestart = new Date(ev.event.start);
           const mydatestop = new Date(ev.event.end);
           my_date_formatstart = format(mydatestart);
            my_date_formatstop = format(mydatestop);
           console.log(my_date_formatstart);
           console.log(my_date_formatstop);
           jQuery.noConflict(); 
           let url = `/calendar/${ev.event.id}/edit`;
           
        $('#hrefid').attr('href',url);
        $('#modalTitle').html(ev.event.title);
           $('#modalBody').html(ev.event._def.extendedProps.description);
           $("#start").html(my_date_formatstart)
            $("#end").html(my_date_formatstop)
         $('#idedit').html(ev.event.id);
        
        $('#exampleModal').modal('show')
        
        
    }),
   
 
        calendar.render();
  });