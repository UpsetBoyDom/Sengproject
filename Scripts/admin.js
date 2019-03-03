$(document).ready(function() {
    
        $.ajax({
        type:"POST",
        url: '../Scripts/lookup.php',
        data:{'patient':true},
        success:function(data) { 
        		
        		var patient = document.getElementById("patient");
        		var content = JSON.parse(data)
        		for (i in content){
        			var cont=0;
        			var row= patient.insertRow(patient.length);
        			for(x in content[i]){
        				var cell=row.insertCell(cont);
        				cell.innerHTML= content[i][x];
        				cont++;

        			}
        		
        		}
              
     
              
            }
      
    });

 function delete_user(uid){
 	console.log("uid " + uid);
 }
        
});