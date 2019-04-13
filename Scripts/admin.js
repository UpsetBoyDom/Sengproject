/**
 * @author Yushae Raza
 * Seng300 Project Iteration 2 Group 4
 * JavaScript use AJAX to retrive nurses, docters and patient from the database
 * 
 */
$(document).ready(function() {
        $.ajax({
        type:"POST",
        url: '../Scripts/lookup.php',
        data:{'patient':true},//data containing patients from the database
        success:function(data) { 
                var patient = document.getElementById("patient");//the table html element
                var content = JSON.parse(data)
        		for (i in content){//for each attribute in the patients json data
        			var cont = 0;//the row number of the patient being displayed in the table
        			var row = patient.insertRow(patient.length);
                    row.scope ="row";
        			for(x in content[i]){
        				var cell=row.insertCell(cont);//for each patient insert their corresponding attribute values in the table
                        cell.scope="col";
        				cell.innerHTML= content[i][x];
        				cont++;

        			}
        		
        		}
              
     
              
            }
      
    });
         $.ajax({
        type:"POST",
        url: '../Scripts/lookup.php',
        data:{'doctors':true},//data containg doctors from the database
        success:function(data) { 
                var patient = document.getElementById("doctors");
                var content = JSON.parse(data);
                console.log(content);
                for (i in content){
                    var cont=0;
                    var row= patient.insertRow(patient.length);
                    row.scope="row";
                    for(x in content[i]){
                        var cell=row.insertCell(cont);
                        cell.scope="col";
                        cell.innerHTML= content[i][x];
                        cont++;

                    }
                
                }
              
     
              
            }
      
    });
    $.ajax({
        type:"POST",
        url: '../Scripts/lookup.php',
        data:{'nurses':true},
        success:function(data) { 
                var patient = document.getElementById("nurses");
                var content = JSON.parse(data)
                console.log(content);
                for (i in content){
                    var cont=0;
                    var row= patient.insertRow(patient.length);
                    row.scope="row";
                    for(x in content[i]){
                        var cell=row.insertCell(cont);
                        cell.scope="col";
                        cell.innerHTML= content[i][x];
                        cont++;

                    }
                
                }
              
     
              
            }
      
    });
})


/**
 * Display the patients table hide the nurses and doctors table
 */
 function view_patients(){
    var patient = document.getElementById('patients_table');
    patient.style="display:block;"
    var patient = document.getElementById('nurses_table');
    patient.style="display:none;"
    var doctors =document.getElementById('docters_table');
     doctors.style="display:none;"
 }

 /**
 * Display the doctors table hide the nurses and patients table
 */
  function view_doctors(){
    var patient = document.getElementById('patients_table');
    patient.style="display:none;"
    var patient = document.getElementById('nurses_table');
    patient.style="display:none;"
    var doctors =document.getElementById('docters_table');
     doctors.style="display:block;"
 }

 /**
 * Display the nurses table hide the patients and doctors table
 */
 function view_nurses(){
    var patient = document.getElementById('patients_table');
    patient.style="display:none;"
    var doctors =document.getElementById('docters_table');
    doctors.style="display:none;"
    var nurses = document.getElementById('nurses_table');
    nurses.style = "display:block;"
 }
