$( function() {
   
    $( ".datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat: "d M y",
      maxDate: new Date()
    });
  } );