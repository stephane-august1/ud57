


  $('.prepa').on("change", function (e) {
   
      e.preventDefault();
    let idselect= $(this).data("id");
        console.log('idselect',idselect);
    let selectchoice = $(this).val();
        console.log('selectchoice',selectchoice);
        console.log('this',this);
    //let newvalueobj= $('#set-'+idselect).data('value',selectchoice);
        let newvalue= $('#set-'+idselect).text();
      //let oldval = $('#set-' + idselect).text();
        let newvalueobj= $('#set-'+idselect).data('value',newvalue);
      console.log('newvalue', newvalueobj);
      
      $('#set-' + idselect).text(selectchoice);
      //on set la class dans l image
      $('#setval').attr('class', selectchoice);
      $('#checkclass').html(selectchoice);
      $('#balise'+idselect).attr('class', selectchoice);
       $('#set-'+idselect).attr('data-myset', selectchoice);
     // $('#balise').attr('class', newvalue);
      let newstatus =  selectchoice;
      let url = $(this).data('route');
    /*  let xmlhttp = new XMLHttpRequest();
      
        // On ouvre la requête
        xmlhttp.open('POST', url, true);

        // On envoie la requête
        xmlhttp.send(null);*/
   
     $.ajax({ 
            type: "POST",

            url: $(this).data('route'), 
            data: {
                'url' :$(this).data('route'),
                 'id': $(this).data("id"),
                'oldstatus': $('#set-'+idselect).data("value"),
                 'imageplace': $('#balise'+idselect).data('value', selectchoice),
                'status': $(this).val(),
             
                },
            async: true,
                success: function(data)
                { 
                    console.log('idselect',idselect);
                    console.log('url', url);
                    console.log('imageplace', newstatus);
                    $('#setval').attr('class', data.newstatus);
    
                },
                error: function(html) 
                {
                    console.log('une erreur');
                    console.log(html.responseText);
                }
        });
     
  });  