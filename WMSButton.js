 const uploadSGM = document.querySelector('#uploadSGM');
 uploadSGM.addEventListener('click', ()=>{
      let filename = document.getElementById("filename").value;
      let response=document.getElementById("saveStatus");
      response.innerHTML="<b><font color='red'>Updating file. please wait...</font></b>";
      let batchId = document.getElementById("BatchID").value;
    
      var data = 'data='+encodeURIComponent(editor_html.getValue())+"&filename="+encodeURIComponent(filename)+"&BatchID="+encodeURIComponent(batchId);
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function(){
          if(xmlhttp.readyState == 4 && xmlhttp.status == 200){
            response.innerHTML="";
            alert("File successfully updated!");
          }
      }

      xmlhttp.open("POST", "updateSGMLFile.php", true);
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send(data);

 });
 
 function saveXML(){
        var Filename = document.getElementById("filename").innerHTML;
        var response=document.getElementById("saveStatus");
        response.innerHTML="<b><font color='red'>saving file. please wait...</font></b>";
        var batchId = document.getElementById("BatchID").value;

        var data = 'data='+encodeURIComponent(editor_html.getValue())+"&filename="+encodeURIComponent(Filename)+"&BatchID="+encodeURIComponent(batchId);
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
            //response.innerHTML=xmlhttp.responseText;

             response.innerHTML="";
             alert("File successfully save!");
          }
        }
        xmlhttp.open("POST","saveXMLFile.php",true);
              //Must add this request header to XMLHttpRequest request for POST
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);

  }
    function StartJob(){

      
      var prFilename=document.getElementById("Status");
      var prTask =document.getElementById("Status");
      var prWorkflow=document.getElementById("Status");
      var chkStatus=document.getElementById("Status");

      var jTextArea = document.getElementById("BatchID1").value;
      var data = 'data='+encodeURIComponent(jTextArea);
      var xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            
           document.getElementById("Start").style.display = "none";
           document.getElementById("Completed").style.display = "block";
           document.getElementById("Pending").style.display = "block";
           document.getElementById("Hold").style.display = "block";
           document.getElementById("Resume").style.display = "none";
            document.getElementById("SaveButton").style.display = "block";

           chkStatus.innerHTML="Ongoing";
            
           

        }
      }
      xmlhttp.open("POST","StartJob.php",true);
            //Must add this request header to XMLHttpRequest request for POST
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      
      xmlhttp.send(data);
      
  }
  function SaveandJobComplete(){
       var prFilename=document.getElementById("filename").innerHTML;
        var JobID=document.getElementById("filename").innerHTML;

        var jTextArea = CKEDITOR.instances['editor1'].getData();
        var data = 'data='+encodeURIComponent(jTextArea) + "&Filename="+prFilename ;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange=function(){
              if (xmlhttp.readyState==4 && xmlhttp.status==200){
                //response.innerHTML=xmlhttp.responseText;
                 alert(xmlhttp.responseText);
                 JobCompleted();
              }
            }
            xmlhttp.open("POST","saveNewHTML.php",true);
                  //Must add this request header to XMLHttpRequest request for POST
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send(data);
    
  }
  
  function PendingJobAndSave(){
    saveXML();
    PendingJob();
  }

  function PendingJob(){
      // var prFilename=document.getElementById("filename").innerHTML+'.doc';
      var chkStatus=document.getElementById("Status");
    
      var jTextArea = document.getElementById("BatchID2").value;
      var data = 'data='+encodeURIComponent(jTextArea);
      var xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
           
           document.getElementById("Start").style.display = "none";
           document.getElementById("Completed").style.display = "none";
           document.getElementById("Pending").style.display = "none";
           document.getElementById("Resume").style.display = "block";
           document.getElementById("SaveButton").style.display = "none";
           document.getElementById("Hold").style.display = "none";
           // document.getElementById("Hold").style.display = "none";
            
           chkStatus.innerHTML="Pending";
           // if (prTask!='CONVERSION'){
           
           	
            // if (document.getElementById("WordViewer").value==1){
            //   SaveandConvert(prFilename);
            // }
            // movePendingFile();
           // }
        }
      }
      xmlhttp.open("POST","PendingJob.php",true);
            //Must add this request header to XMLHttpRequest request for POST
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      
      xmlhttp.send(data);
      
  }

  function HoldJob(){
      var prFilename=document.getElementById("filename").innerHTML+'.doc';
      var chkStatus=document.getElementById("Status");
      var BookID= document.getElementById("BookID").value;
      var jTextArea = document.getElementById("xBatchID").value;
      var data = 'data='+encodeURIComponent(jTextArea);
      var xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
           
           document.getElementById("Start").style.display = "none";
           document.getElementById("Completed").style.display = "none";
           document.getElementById("Pending").style.display = "none";
           document.getElementById("Resume").style.display = "none";
           document.getElementById("Hold").style.display = "none";
            
           chkStatus.innerHTML="Hold";
           // if (prTask!='CONVERSION'){
           
            
            if (document.getElementById("WordViewer").value==1){
              SaveandConvert(prFilename);
            }
            // movePendingFile();
           // }
        }
      }
      xmlhttp.open("POST","HoldJob.php",true);
            //Must add this request header to XMLHttpRequest request for POST
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      
      xmlhttp.send(data);
      
  }

function LoadAutomation(){
    var response=document.getElementById("AutomationList");
    //var jTextArea=document.getElementById("jTextArea").value;
    var jTextArea = "";
    var data = 'data='+encodeURIComponent(jTextArea);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
      if (xmlhttp.readyState==4 && xmlhttp.status==200){
        response.innerHTML=xmlhttp.responseText;
          
      }
    }
    xmlhttp.open("POST","LoadAutomation.php",true);
          //Must add this request header to XMLHttpRequest request for POST
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xmlhttp.send(data);
  
}

function DownloadXMLAndComplete(){
    GetJobStatus();
    JobCompleted();

}

function saveXMLAndComplete(){

    // var ValidateTrigger = document.getElementById("ValidateTrigger").value;
    // // ValidateTrigger='';
    // if (ValidateTrigger==''){
      saveXML();
      JobCompleted();
    // }
    // else{
    //   alert("Please validate or fix the error posted on the Validation Logs.");
    // }
    
}

function JobCompleted(){
    
      var chkStatus=document.getElementById("Status");
      var jTextArea = document.getElementById("BatchID").value;
        var Task = document.getElementById("Task").value;
      var RelevantValue = document.getElementById("RelevantValue").value;
      var data = 'data='+encodeURIComponent(jTextArea)+"&RelevantValue="+RelevantValue;

      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("Start").style.display = "none";
            document.getElementById("Completed").style.display = "none";
            document.getElementById("Pending").style.display = "none";
            document.getElementById("Resume").style.display = "none";
            document.getElementById("GetNext").style.display = "block";
            document.getElementById("Hold").style.display = "none";
            alert("Batch is successfully completed");
            chkStatus.innerHTML="Completed";
            document.getElementById("SaveButton").style.display = "none";
          location.reload();
        }
      }
      xmlhttp.open("POST","SetAsCompleted.php",true);
            //Must add this request header to XMLHttpRequest request for POST
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      
      xmlhttp.send(data);
}
      
  // }
function saveQAResult(BatchName,QAResult){
      var data = 'data='+encodeURIComponent(BatchName + "||" + QAResult);

      var xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            // alert  (xmlhttp.responseText);
            // document.getElementById("CheckIN").style.display = "none"; 
        }
      }
      xmlhttp.open("POST","saveQAResult.php",true);
            //Must add this request header to XMLHttpRequest request for POST
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      
      xmlhttp.send(data);
}

function getChecklist(BatchID){
    var elements = document.getElementById("frmDataEntry").elements;
      
      for (var i = 0, element; element = elements[i++];) {
         
            if (element.type==='checkbox'){
              if (element.name!=''){
                saveCheckList(BatchID,element.name,element.checked);
              }
            
            }
            else{
           
               if (element.name!=''){
                saveCheckList(BatchID,element.name,element.value);
              }
            }
            
      }
  }

function saveCheckList(BatchID,ElementName,ElementValue){

    var data = 'data='+encodeURIComponent(BatchID + "||" + ElementName + "||" + ElementValue);

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange=function(){
      if (xmlhttp.readyState==4 && xmlhttp.status==200){
              
          // document.getElementById("CheckIN").style.display = "none"; 
      }
    }
    xmlhttp.open("POST","saveCheckList.php",true);
          //Must add this request header to XMLHttpRequest request for POST
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xmlhttp.send(data);
}


function CheckIN(prJobname){

      // ExecuteConversion(prJobname);
      var data = 'data='+encodeURIComponent(prJobname + "||" + editor_html.getValue());

      var xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
            
            document.getElementById("CheckIN").style.display = "none"; 
        }
      }
      xmlhttp.open("POST","CheckIN.php",true);
            //Must add this request header to XMLHttpRequest request for POST
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      
      xmlhttp.send(data);
      
}

function Resume(prFilename,prTask){
      var chkStatus=document.getElementById("Status");
      var jTextArea = document.getElementById("BatchID1").value;
      var data = 'data='+encodeURIComponent(jTextArea);
      var xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
           
           document.getElementById("Start").style.display = "none";
           document.getElementById("Completed").style.display = "block";
           document.getElementById("Pending").style.display = "block";
            document.getElementById("Hold").style.display = "block";
           document.getElementById("Resume").style.display = "none";
           chkStatus.innerHTML="Ongoing";
           // if (prTask!='CONVERSION'){
          
           // }

        }
      }
      xmlhttp.open("POST","StartJob.php",true);
            //Must add this request header to XMLHttpRequest request for POST
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      
      xmlhttp.send(data);
      
}

function movePendingFile(prFilename){
       
      // var prFilename=document.getElementById("filename").innerHTML+'.doc';
      var BookID= document.getElementById("BookID").value;
      
      var jTextArea = BookID+"@@@"+prFilename+"@@@"+document.getElementById("BatchName").value;
      var data = 'data='+encodeURIComponent(jTextArea);
      var xmlhttp = new XMLHttpRequest();

      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
           
        }
      }
      xmlhttp.open("POST","movePendingFile.php",true);
            //Must add this request header to XMLHttpRequest request for POST
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      
      xmlhttp.send(data);

}

function saveHTMLFile(){
    var prFilename=document.getElementById("filename").innerHTML;
    

    var jTextArea = CKEDITOR.instances['editor1'].getData();
    var data = 'data='+encodeURIComponent(jTextArea) + "&Filename="+prFilename ;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
      if (xmlhttp.readyState==4 && xmlhttp.status==200){
        //response.innerHTML=xmlhttp.responseText;
          alert(xmlhttp.responseText);
      }
    }
    xmlhttp.open("POST","saveNewHTML.php",true);
          //Must add this request header to XMLHttpRequest request for POST
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send(data);
}


function ConvertPDFHTML(){

    document.getElementById("HTMLCon").innerHTML="<li>Converting PDF to HTML. Please wait...</li>";
      
    var jTextArea = document.getElementById("filename").innerHTML;
    var data = 'data='+encodeURIComponent(jTextArea);
    var xmlhttp = new XMLHttpRequest();

    xmlhttp.onreadystatechange=function(){
      if (xmlhttp.readyState==4 && xmlhttp.status==200){
            document.getElementById("HTMLCon").innerHTML=xmlhttp.responseText;
          
      }
    }
    xmlhttp.open("POST","ConvertPDFHTML.php",true);
          //Must add this request header to XMLHttpRequest request for POST
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xmlhttp.send(data);
       
}
  
function ValidateXML(){
       var Filename = document.getElementById("filename").innerHTML;
        $("#modal-validate").modal();
        var response = document.getElementById("ValidationList");
        var data = 'data='+encodeURIComponent(editor_html.getValue())+"&filename="+encodeURIComponent(Filename);
        
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange=function(){
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
            response.innerHTML = xmlhttp.responseText;
             document.getElementById("ValidateTrigger").value =  xmlhttp.responseText.trim();
            $('#modal-validate').modal('hide');
            alert("File successfully validated!");
            $("#ValidationList").html('<p style="color:green; font-size:14px;">Validated</p>');
          }
        }
        xmlhttp.open("POST","ValidateXML.php",true);
        //Must add this request header to XMLHttpRequest request for POST
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xmlhttp.send(data);

}

function DisableTag(prToggle){
      var doc = editor_html.getDoc();
      var cursor = doc.getCursor();
      var content =doc.getLine(cursor.line);
      
      var n = content.length;

      var startChar;
      var endChar
      for (i=0; i<n;i++){

        if (content.substr(i,1)==="<"){
          startChar = i;
        }

        if(content.substr(i,1)==="\>"){
          endChar =i;
          // alert(startChar);
          // alert(endChar);
          // alert(content.substr(startChar,endChar));
          if (prToggle==1){
            editor_html.markText({line:cursor.line,ch:startChar},{line:cursor.line,ch:endChar+1},{readOnly:true});  
          }
          else{
            editor_html.markText({line:cursor.line,ch:startChar},{line:cursor.line,ch:endChar+1},{readOnly:false});   
          }
          


        }


      }



            
}

function SpellCheck(){
    if (document.getElementById("SpellCheck").value=='SpellCheck'){
        editor_html.setSize("0","0");
        document.getElementById("spellcheckText").style.display="block";  
        document.getElementById("Validate").style.display="none";  
        document.getElementById("btnSave").style.display="none";  
        document.getElementById("spellcheckText").value=editor_html.getValue();
        document.getElementById("SpellCheck").value="Back To XML View";
    }else{
        editor_html.setSize("100%","65vh");
        document.getElementById("spellcheckText").style.display="none";  
        document.getElementById("SpellCheck").value="SpellCheck";
        editor_html.setValue(document.getElementById("spellcheckText").value);
        document.getElementById("Validate").style.display="inline";  
        document.getElementById("btnSave").style.display="inline";  
    }

}