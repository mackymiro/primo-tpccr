

  function BatchHold(){
         
        var sBatchID=document.getElementById("BatchIDHold").value;
     
        var data = 'data='+sBatchID;
        var BatchID='';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
            // alert(xmlhttp.responseText);
            for (var i = 0; i < frmTracking.elements.length; i++ ) {
                if (frmTracking.elements[i].type == 'checkbox') {
                    if (frmTracking.elements[i].checked == true) {
                      try{
                        BatchID= frmTracking.elements[i].value;
                       
                        document.getElementById("Status" + BatchID).innerHTML = "Hold";
                       
                      }
                      catch(err){

                      }
                      
                    }
                }
                
            }
            ClearCheckBox();
            alert("Batch successfully hold!");
        
          }
        } 
        xmlhttp.open("POST","BatchHold.php",true);
              //Must add this request header to XMLHttpRequest request for POST
              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);

      }

  function BatchAllocateToUser(){
         
        var sBatchID=document.getElementById("BBatchID").value;
      
        var UserName=document.getElementById("BUserName").value;
        var BUserName=document.getElementById("BUserName");
     
        var data = 'data='+sBatchID +"@@@"+UserName;
        var BatchID='';
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
            
            for (var i = 0; i < frmTracking.elements.length; i++ ) {
                if (frmTracking.elements[i].type == 'checkbox') {
                    if (frmTracking.elements[i].checked == true) {
                      try{
                        BatchID= frmTracking.elements[i].value;
                        document.getElementById("User" + BatchID).innerHTML = BUserName.options[BUserName.selectedIndex].text;
                        document.getElementById("Status" + BatchID).innerHTML = "Allocated";
                        document.getElementById("btnAllocate" + BatchID).style.display = 'none';  
                      }
                      catch(err){
                        // do nothing
                      }
                      
                    }
                }
                
            }

            ClearCheckBox();

            alert("File successfully allocated!");
        
          }
        } 
        xmlhttp.open("POST","BatchallocateToUser.php",true);
              //Must add this request header to XMLHttpRequest request for POST
              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);



      }

      function AllocateBatchToUser(){
         
        var BatchID=document.getElementById("BatchID").value;
      
        var UserName=document.getElementById("UserName").value;
         var BUserName=document.getElementById("UserName");
        var btnAllocate=document.getElementById("btnAllocate" + BatchID);
        var data = 'data='+BatchID  +"@@@"+UserName;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
            //response.innerHTML=sxmlhttp.responseText;
             // alert(xmlhttp.responseText);
            btnAllocate.style.display = "none";
            document.getElementById("User" + BatchID).innerHTML = BUserName.options[BUserName.selectedIndex].text;
            document.getElementById("Status" + BatchID).innerHTML = "Allocated";
            alert("File successfully allocated!");
        
          }
        } 
        xmlhttp.open("POST","allocateToBUser.php",true);
              //Must add this request header to XMLHttpRequest request for POST
              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);

      }
  function DeleteRecord(){
         
        var BatchID=document.getElementById("BatchID").value;
      
        
        var data = 'data='+BatchID;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
            //response.innerHTML=xmlhttp.responseText;
            document.getElementById(BatchID).style.display='none';
            alert("File successfully deleted!");
            // location.reload();
          }
        }
        xmlhttp.open("POST","DeleteRecord.php",true);
              //Must add this request header to XMLHttpRequest request for POST
              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);

      }


      function UnholdJob(){
         
        var BatchID=document.getElementById("BatchID1").value;
        var UserName=document.getElementById("UserNameUnhold").value;
      
        
        
        var data = 'BatchID='+BatchID+"&UserName="+UserName;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
            //response.innerHTML=xmlhttp.responseText;
            // alert(xmlhttp.responseText);
            // document.getElementById(BatchID).style.display='none';
             document.getElementById("User" + BatchID).innerHTML = UserName;
             document.getElementById("Status" + BatchID).innerHTML = "Allocated";
            alert("File successfully unhold!");
            // location.reload();
          }
        }
        xmlhttp.open("POST","UnHoldJob.php",true);
              //Must add this request header to XMLHttpRequest request for POST
              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);

      }

       function BatchReflow(){

          var BatchName=document.getElementById("BatchName").value;
          var RuleName=document.getElementById("RuleName").value;
          
          // var BatchID=document.getElementById("BatchID").value;



          var cbResults='|';
          for (var i = 0; i < frmTracking.elements.length; i++ ) {
              if (frmTracking.elements[i].type == 'checkbox') {
                  if (frmTracking.elements[i].checked == true) {
                      cbResults += frmTracking.elements[i].value + '|';
                  }
              }
              
          }
          


          var UserName=document.getElementById("UserName2").value;
           var BUserName=document.getElementById("UserName2");
          var BatchID='';
         
          
          var data = 'BatchName='+BatchName+"&RuleName="+RuleName+"&BatchID="+BatchID+"&UserName="+UserName;
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
              //response.innerHTML=xmlhttp.responseText;
              // alert(xmlhttp.responseText);
              // document.getElementById(BatchID).style.display='none';

                 for (var i = 0; i < frmTracking.elements.length; i++ ) {
                      if (frmTracking.elements[i].type == 'checkbox') {
                          if (frmTracking.elements[i].checked == true) {
                            try{
                              BatchID= frmTracking.elements[i].value;
                              document.getElementById("User" + BatchID).innerHTML = BUserName.options[BUserName.selectedIndex].text;
                              document.getElementById("Status" + BatchID).innerHTML = "Allocated";
                              document.getElementById("btnAllocate" + BatchID).style.display = 'none';  
                            }
                            catch(err){

                            }
                            
                          }
                      }
                      
                  }

             ClearCheckBox();
              
              alert("File successfully Reflow!");
              // location.reload();
            }
          }
          xmlhttp.open("POST","BatchReflowProcess.php",true);
                //Must add this request header to XMLHttpRequest request for POST
                xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          xmlhttp.send(data);

        

       }

      

       


      function Reflow(){
         
        var BatchName=document.getElementById("BatchName").value;
        var RuleName=document.getElementById("RuleName").value;
        
        var BatchID=document.getElementById("BatchID").value;
        var UserName=document.getElementById("UserName1").value;
       var BUserName=document.getElementById("UserName1");
        var btnAllocate=document.getElementById("btnAllocate" + BatchID);
       
        
        var data = 'BatchName='+BatchName+"&RuleName="+RuleName+"&BatchID="+BatchID+"&UserName="+UserName;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
            //response.innerHTML=xmlhttp.responseText;
            // alert(xmlhttp.responseText);
            // document.getElementById(BatchID).style.display='none';
             document.getElementById("User" + BatchID).innerHTML = BUserName.options[BUserName.selectedIndex].text;
            document.getElementById("Status" + BatchID).innerHTML = "Allocated";
               btnAllocate.style.display = 'none';
            
            alert("File successfully Reflow!");
            // location.reload();
          }
        }
        xmlhttp.open("POST","ReflowProcess.php",true);
              //Must add this request header to XMLHttpRequest request for POST
              xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);

      }


    function checkAll(checkId){
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) { 
            if (inputs[i].type == "checkbox" && inputs[i].id == checkId) { 
                if(inputs[i].checked == true) {
                    inputs[i].checked = false ;
                } else if (inputs[i].checked == false ) {
                    inputs[i].checked = true ;
                }
            }  
        }  
    }

        function SetTextBoxValue($prVal) {
    
            document.getElementById('BatchID').value = $prVal;

        }
     function SetTextBoxValue1($prVal) {
       
            document.getElementById('BatchID1').value = $prVal;

        }
        function SetTextBoxBatch($prVal,BatchID) {
       
            document.getElementById('BatchName').value = $prVal;
            document.getElementById('BatchID').value = BatchID;

        }
      function SetTextBoxValue2($prVal) {
       
            document.getElementById('BatchID2').value = $prVal;

        }

      function ClearCheckBox(){

          for (var i = 0; i < frmTracking.elements.length; i++ ) {
              if (frmTracking.elements[i].type == 'checkbox') {
                if (frmTracking.elements[i].checked == true) {
                    frmTracking.elements[i].checked = false;
                }
              }
          }
        }
      function DisplayReadyForAllocate(){
          var cbResults = '<b>List of Batches:</b><br>';
          var BatchList='';

            for (var i = 0; i < frmTracking.elements.length; i++ ) {
                if (frmTracking.elements[i].type == 'checkbox') {
                    if (frmTracking.elements[i].checked == true) {
                      try{

                        if (document.getElementById("Status" + frmTracking.elements[i].value).innerHTML=='New'||document.getElementById("Status" + frmTracking.elements[i].value).innerHTML=='Allocated'){
                          cbResults += frmTracking.elements[i].value + "- Ready for Allocation"  + '<br>';
                           BatchList=BatchList + frmTracking.elements[i].value +"|";

                        }
                        else{


                          cbResults += frmTracking.elements[i].value + "- Unable to allocate this batch status, should be New"  + '<br>';                          
                        }

                      
                      }
                        
                        catch(err){
                          // do nothing
                        }


                         
                    }
                }
                
            
            }
            document.getElementById("BBatchID").value = BatchList;
            document.getElementById("BatchListForAllocation").innerHTML = cbResults;
       }

        function DisplayReadyForReAllocate(){
          var cbResults = '<b>List of Batches:</b><br>';
          var BatchList='';

            for (var i = 0; i < frmTracking.elements.length; i++ ) {
                if (frmTracking.elements[i].type == 'checkbox') {
                    if (frmTracking.elements[i].checked == true) {
                      try{

                        if (document.getElementById("Status" + frmTracking.elements[i].value).innerHTML=='New'){
                          cbResults += frmTracking.elements[i].value + "- Ready for Allocation"  + '<br>';
                           BatchList=BatchList + frmTracking.elements[i].value +"|";

                        }
                        else{


                          cbResults += frmTracking.elements[i].value + "- Unable to allocate this batch status, should be New"  + '<br>';                          
                        }

                      
                      }
                        
                        catch(err){
                          // do nothing
                        }


                         
                    }
                }
                
            
            }
            document.getElementById("BBatchID").value = BatchList;
            document.getElementById("BatchListForAllocation").innerHTML = cbResults;
       }
   function DisplayReadyForHold(){
          var cbResults = '<b>List of Batches:</b><br>';
          var BatchList='';

            for (var i = 0; i < frmTracking.elements.length; i++ ) {
                if (frmTracking.elements[i].type == 'checkbox') {
                    if (frmTracking.elements[i].checked == true) {
                      try{
                          if (document.getElementById("Status" + frmTracking.elements[i].value).innerHTML!='Done' && document.getElementById("Status" + frmTracking.elements[i].value).innerHTML!='Hold'){
                          cbResults += frmTracking.elements[i].value + "- Ready for Hold"  + '<br>';
                           BatchList=BatchList + frmTracking.elements[i].value +"|";

                        }
                        else{


                          cbResults += frmTracking.elements[i].value + "- Unable to hold this batch status, should not be done or hold."  + '<br>';                          
                        }
                      }
                      catch(err){
                        // do nothing
                      }

                      
                        


                         
                    }
                }
                
            
            }
            document.getElementById("BatchIDHold").value = BatchList;
            document.getElementById("BatchListForHold").innerHTML = cbResults;
       }