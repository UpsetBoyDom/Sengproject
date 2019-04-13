/**
 * Return time duration between the first and second day as a floored number
 * @param first first day used for comparison
 * @param second second day used for comparison
 * @return the floor of the duration between first and second
 */
function daysBetween(first, second) {

    // Copy date parts of the timestamps, discarding the time parts.
    var one = new Date(first.getFullYear(), first.getMonth(), first.getDate());
    var two = new Date(second.getFullYear(), second.getMonth(), second.getDate());

    // Do the math.
    var millisecondsPerDay = 1000 * 60 * 60 * 24;
    var millisBetween = two.getTime() - one.getTime();
    var days = millisBetween / millisecondsPerDay;

    // Round down.
    return Math.floor(days);
}
var events=[];
$(document).ready(function() {
  update_selections("doctors","`Doctor_ID`,`FullName`","sel_doc");
  update_pselections("Users","`UserId`,`Name`","patients_sel");

  var doc =new URLSearchParams(window.location.search);
  
  // page is now ready, initialize the calendar...
  var today= new Date;
  var hour =today.getHours();
  var event;
  var id = 0;
  event= {id, title: 'appointment'+id, start: new Date()};
  $('#calendar').fullCalendar('renderEvent',event,true);
  $('#calendar').fullCalendar({
    selectable: true,
   
    // customize fullcalendar properties
    weekends: false,
    heightL: 700,
    aspectRatio: 2,   
    defaultTimedEventDuration: '01:00:00',
    slotDuration: '01:00:00',
    slotLabelInterval: 60,

    header: {
      left:'prev, next, today',
      center: 'title',
      right: 'addEvent, month, agendaWeek, agendaDay'
    },
    themeSystem: 'bootstrap4',
    nowIndicator: true,
    //cday click event
     
    agendaDay : function (date, cell) {
    cell.css("background-color", "red");
    },
    eventClick: function(calEvent, jsEvent, view) {
    $("#title").text(calEvent.title);
    $("#desc").text(calEvent.description);
    $("#appoinmentid").text(calEvent.id);
    console.log("id " + $("#appoinmentid").text())
      
    $("#start").text(calEvent.start);
    $("#end").text(calEvent.end);
    $("#appoinment-details").modal();
    },
    selectOverlap :false,
    select: function(start, end, jsEvent, view) {
      $('#calendar').fullCalendar('unselect');
      //console.log("hi")
      if(start.hasTime()){
        if (!IsDateHasEvent(start)) {
                var from= moment(start).format("YYYY-MM-DD HH:mm:ss");//start date and time of the event
                var end= moment(end).format("YYYY-MM-DD HH:mm:ss");//end date and time of the event
                var doc=document.getElementById("sel_doc");//the select html element found in yushae.com/Seng300/Booking
                var did= doc.options[doc.selectedIndex].value;//get the doctor from the select element options
                if(did!="select"){//if a doctor is selected from the select options continue
                    $("#appoinment").modal();//open the appointment modal
                    console.log(from);
                    $('form').off('submit');
                    $('form').on('submit', function (e) {
                      console.log(from);
                      e.preventDefault();
                       
                      var pat= document.getElementById("patients_sel");//the patient selected from the drop down menu html select element
                      var pname= pat.options[pat.selectedIndex].text;//get the name of the patient
                      var dname= doc.options[doc.selectedIndex].text;//get the name of the doctor
                       
                      var title= "Dr. " +dname+ "s appoinment with " +pname;//title for the appointment
                      $("#appoinment").modal('hide');
                      var dat= $('form').serialize()+ "&from=" + from+"&till=" + end+"&title=" + title+"&doc_id=" + did;
                      $('form').trigger("reset");
                  
                      $.ajax({//use ajax to update the page asynchronously with the new appointment
                        type: 'post',
                        url: '../Scripts/lookup.php',
                        data: dat,
                        success: function (data) {
                          $('#msg').empty();
                          $('#msg').append(data);
                          select_doc(doc);
                          //animate error message on page
                          $('#response_msg').addClass(' alert-success');
                          $('#response_msg').fadeTo(2000, 500).slideUp(500, function(){
                          $("#response_msg").slideUp(500);
                          });                                                     
                        }
                      });
                   }); $('#calendar').fullCalendar('refetchEvents');//update the calendar to display new appointment
                }
              else{
                $('#msg').empty();
                $('#msg').append("Please select a doctor");//error message if no doctor is selected from the html select element                
                $('#response_msg').addClass('alert-warning');
                $('#response_msg').fadeTo(2000, 500).slideUp(500, function(){
                $("#response_msg").slideUp(500);//animate the error message on screen
                });   
                
              }
        }
      }
      $('#calendar').fullCalendar('unselect')//unselect the date and time after succesfully creating a new appointment
    },
   

    // Call script to colour each day
    // based on availability from database

    // Clicking a date pulls up form to book appt
    dayClick: function(date, jsEvent, view) {
      var current= new Date();
      var hour =current.getHours()+1;
      var time =hour+":00:00";

      defaultView: 'agendaWeek';
      var check =date.toJSON().slice(0,10);
      var today =current.toJSON().slice(0,10) ;
      console.log(today)
  
        if(today==check){
            $('#calendar').fullCalendar('option', { minTime: time })
        }
        if(check >= today){
          $('#calendar').fullCalendar('gotoDate',date);
          $('#calendar').fullCalendar('changeView','agendaDay');
        } 

    },
    events: function(start, end, timezone, callback) {
         callback(events);
  },   eventMouseover:function(event,domEvent,view){
          
        $('[data-date="'+moment(event.eventend).format('YYYY-MM-DD')+'"]').addClass('highlightcell');
    },
    eventMouseout:function(event){
        $('[data-date="'+moment(event.eventend).format('YYYY-MM-DD')+'"]').removeClass('highlightcell');
    }


     
             
     

    
  })
});

/**
 * Hide the html element with id = 'close_alert
 */
function close_alert(){
  $('#close_alert').hide();
  return false;
} 

/**
 * Update the html select element with doctors from the database
 * @param tbname the table name
 * @param col_name the attribute name
 * @param id the html element id
 */
function update_selections(tbname,col_name,id){
  $.ajax({//asynchronously update the page using
        type:"POST",
        url: '../Scripts/lookup.php',//
        data:{'table':tbname,'column_name':col_name},
        success:function(data) { 
            var docter= document.getElementById(id);           
            var content = JSON.parse(data)
            console.log(content)
            for (i in content){//add doctors from the database to select 
                var option=document.createElement("option");
                option.value=content[i]["Doctor_ID"];
                option.text=content[i]["FullName"];
                docter.add(option);   
            } 
            }
    });
}

/**
 * Populate the html select element with nurses from the database
 * @param  tbname the table name in the mysql database
 * @param  col_name the attribute name in the table
 * @param  id the html select element used to select nurses
 */
function update_selections_nurse(tbname,col_name,id){
  $.ajax({
        type:"POST",
        url: '../Scripts/lookup.php',//perform sql query to return 
        data:{'table':tbname,'column_name':col_name},
        success:function(data) { 
            var docter= document.getElementById(id);           
            var content = JSON.parse(data)
            console.log(content)
            for (i in content){
                var option=document.createElement("option");
                option.value=content[i]["Nurse_ID"];
                option.text=content[i]["FullName"];
                docter.add(option);                          
            }              
            }      
    });
}

/**
 * Update the html select element with patients from the database
 * @param tbname table name
 * @param col_name attribute name
 * @param id the html element id 
 */
function update_pselections(tbname,col_name,id){

  $.ajax({
        type:"POST",
        url: '../Scripts/lookup.php',
        data:{'table':tbname,'column_name':col_name},
        success:function(data) { 
            var docter= document.getElementById(id);
           
            var content = JSON.parse(data)
             console.log(content)
            for (i in content){
                var option=document.createElement("option");
                option.value=content[i]["UserId"];
                option.text=content[i]["Name"];
                docter.add(option);
            }
            }
    });
}

/**
 * Show the html element with id = "myForm"
 */
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

/**
 * Hide the html element with id = "myForm"
 */
function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

/**
 * Delete a selected appointment
 */
function delete_appointment(){
  var id = $("#appoinmentid").text();
  var doc=document.getElementById("sel_doc");
  $("#appoinment-details").modal('hide');
   $.ajax({
      type:"POST",
      url: '../Scripts/lookup.php',     
      data: {
        // our hypothetical feed requires UNIX timestamps
        delete:id//delete the appointment from the data base the corresponds to id 
      },
      success: function(data) {
      console.log(data);
      select_doc(doc);//update the calendars display after deleting the appointment  
    }
  });
}

/**
 * Render appointments for the corresponding doctor @param doc
 * @param doc the doctor being selected from the select element
 */
function select_doc(doc){
    var doc_id = doc.options[doc.selectedIndex].value;//the doctor selected from the html select element
    if(doc_id!="select"){//if a doctor is selected perform ajax 
      $.ajax({
      type:"POST",
      url: '../Scripts/lookup.php',//use sql query to update the 
      dataType: 'JSON',
      data: {
        // our hypothetical feed requires UNIX timestamps
        docid:doc_id
      },
      success: function(data) {
       console.log(data)
        var events = data.events;
        $('#calendar').fullCalendar('removeEvents');
        $('#calendar').fullCalendar( 'addEventSource', events );
        $('#calendar').fullCalendar( 'rerenderEvents'); 
        $('#calendar').fullCalendar('refetchEvents');
      }
    });
   
    }
}
/**
 * Return boolean if the date has event
 * @param date the desired date 
 * @return boolean if the start
 */
function IsDateHasEvent(date) {
    var allEvents = [];
    // add your calendar events into the array. 
    allEvents = $('#calendar').fullCalendar('clientEvents');
    var event = $.grep(allEvents, function (v) {
        return +v.start === +date;
    });
    return event.length > 0;
}