function saveXML(){
     alert("The file is successfully saved!");
}

function JobRewind(){
    JobID = document.getElementById("GGJobID").value;
    Filename = document.getElementById("filename").innerHTML;

    var response=document.getElementById("GGStatus");
    response.innerHTML="<b><font color='red'>Job Rewind...</font></b>";

    //var jTextArea=document.getElementById("jTextArea").value;
    var jTextArea = "index";
    var data = 'data='+encodeURIComponent(JobID)+"&filename="+encodeURIComponent(Filename);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
          response.innerHTML=xmlhttp.responseText;
          GetJobStatus();
        }
    }
    // xmlhttp.open("POST","GGGetStatus.php",true);
    xmlhttp.open("POST","JobRewind.php",true);
    //Must add this request header to XMLHttpRequest request for POST
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    xmlhttp.send(data);
}

function GetJobStatus(){
  
  var TokenVAL =document.getElementById("TokenVal").value;
  //var TokenVAL ='dXNlci10ZXN0LTUzY2FkNzZmYzIzOGUzNTgwNWU5NjgzY2YxNDFlNTE4ZjliZWUzMTA6';

	JobID = document.getElementById("GGJobID").value;
	Filename = document.getElementById("filename").innerHTML;
  BatchID = document.getElementById("BatchID").value;
  
  
  var response=document.getElementById("GGStatus");
  response.innerHTML="<b><font color='red'>checking status...</font></b>";
  //var jTextArea=document.getElementById("jTextArea").value;
  var jTextArea = "index";
  var data = 'data='+encodeURIComponent(JobID)+"&filename="+encodeURIComponent(Filename)+"&BatchID="+encodeURIComponent(BatchID);
  console.log(data);
  // +"&token="+encodeURIComponent(token)
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState==4 && xmlhttp.status==200){
    	

      document.getElementById('GoldenGateFrame').src = document.getElementById('GoldenGateFrame').src;
      response.innerHTML=xmlhttp.responseText;
      
      if (response.innerHTML.trim()=='completed(100%)'){
        LoadDataEntryContent(Filename);
        
      }
      else if(response.innerHTML.trim()=='blocked(55%)'){
        document.getElementById("GoldenGateLink").href="https://wb.innodatalabs.com/zoning/#/job/" + JobID + "?token=" + TokenVAL;
        document.getElementById("GoldenGateFrame").src="https://wb.innodatalabs.com/zoning/#/job/" + JobID + "?token=" + TokenVAL;
      }
      else if(response.innerHTML.trim()=='blocked(59%)'){
        document.getElementById("GoldenGateLink").href="https://wb.innodatalabs.com/zoning/#/job/" + JobID + "?token=" + TokenVAL;
        document.getElementById("GoldenGateFrame").src="https://wb.innodatalabs.com/zoning/#/job/" + JobID + "?token=" + TokenVAL;
      }
      else if(response.innerHTML.trim()=='blocked(80%)'){
        document.getElementById("GoldenGateLink").href="https://wb.innodatalabs.com/reading/#/job/" + JobID + "?token=" + TokenVAL;
        document.getElementById("GoldenGateFrame").src="https://wb.innodatalabs.com/reading/#/job/" + JobID + "?token=" + TokenVAL;
      }
      else if(response.innerHTML.trim()=='blocked(95%)'){
        document.getElementById("GoldenGateLink").href="https://wb.innodatalabs.com/mapping/#/job/" + JobID + "?token=" + TokenVAL;
        document.getElementById("GoldenGateFrame").src="https://wb.innodatalabs.com/mapping/#/job/" + JobID + "?token=" + TokenVAL;
      }
      else if(response.innerHTML.trim()=='blocked(97%)'){
        document.getElementById("GoldenGateLink").href="https://wb.innodatalabs.com/mapping/#/job/" + JobID + "?token=" + TokenVAL;
        document.getElementById("GoldenGateFrame").src="https://wb.innodatalabs.com/mapping/#/job/" + JobID + "?token=" + TokenVAL;
      }

      UpdatePDFInfo(JobID,Filename,token);
      
    }
  }
  // xmlhttp.open("POST","GGGetStatus.php",true);
   xmlhttp.open("POST","GetStatusService.php",true);
        //Must add this request header to XMLHttpRequest request for POST
  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  
  xmlhttp.send(data);
  // },
  // failure: function(errMsg) {
  //     console.log(errMsg);
}
// }); 



function LoadDataEntryContent(prFilename){
    editor_html.setValue("");
    var data = 'data='+encodeURIComponent(prFilename);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
      if (xmlhttp.readyState==4 && xmlhttp.status==200){
      
      editor_html.setValue(xmlhttp.responseText);
      

      }
    }
    xmlhttp.open("POST","XMLReader.php",true);
          //Must add this request header to XMLHttpRequest request for POST
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xmlhttp.send(data);
}

function RefreshEditor() {
    editor_html.refresh();
    // var totalLines = editor_html.lineCount();
    // editor_html.autoFormatRange({line:0, ch:0}, {line:totalLines});
}

function SaveDataEntry() {
    var data = 'filename='+encodeURIComponent(document.getElementById("filename").innerHTML) + "&Title="+encodeURIComponent(document.getElementById("Title").value)+"&OriginatingDate="+encodeURIComponent(document.getElementById("OriginatingDate").value)+"&Register="+encodeURIComponent(document.getElementById("Register").value)+"&Type="+encodeURIComponent(document.getElementById("Type").value)+"&Priority="+encodeURIComponent(document.getElementById("Priority").value)+"&Topic="+encodeURIComponent(document.getElementById("Topic").value)+"&Status="+encodeURIComponent(document.getElementById("Status").value)+"&StateDate="+encodeURIComponent(document.getElementById("StateDate").value)+"&Remarks="+encodeURIComponent(document.getElementById("Remarks").value);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
      if (xmlhttp.readyState==4 && xmlhttp.status==200){
          // alert("Record Successfully saved!");
      }
    }
    xmlhttp.open("POST","SavetoJSON.php",true);
          //Must add this request header to XMLHttpRequest request for POST
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xmlhttp.send(data);
};


function GetJobStatusAndSave(){
  JobID = document.getElementById("GGJobID").value;

  Filename = document.getElementById("filename").innerHTML;
  $.ajax({
      type: "POST",
      url: "https://api.innodata.com/v1.1/users/login",
      data: JSON.stringify({ authentication_method:"password",username:"hj1@innodata.com", password:"test@1qaz"}),
      contentType: "application/json; charset=utf-8",
      dataType: "json",
      success: function(result){  
        console.log("STEP 1");
            // console.log(result)         
          var stringified = JSON.stringify(result);
          var parsedObj = JSON.parse(stringified);
          // var token = parsedObj.response.api_keys.live;
          var token = parsedObj.response.api_keys.test;
          // var Filename="<?php echo trim($_GET['filename']);?>"; 
              // step2(token,Filename);


          var response=document.getElementById("GGStatus");
          response.innerHTML="<b><font color='red'>checking status...</font></b>";

          //var jTextArea=document.getElementById("jTextArea").value;
          var jTextArea = "index";
          var data = 'data='+encodeURIComponent(JobID)+"&filename="+encodeURIComponent(Filename)+"&token="+encodeURIComponent(token);
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
              document.getElementById('GoldenGateFrame').src = document.getElementById('GoldenGateFrame').src;
              response.innerHTML=xmlhttp.responseText;
              
              if (response.innerHTML.trim()=='completed(100%)'){
                LoadDataEntryContent(Filename);
                JobCompleted();
              }
              
            }
          }
          xmlhttp.open("POST","GGGetStatus.php",true);
                //Must add this request header to XMLHttpRequest request for POST
          xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          
          xmlhttp.send(data);
      },
      failure: function(errMsg) {
          console.log(errMsg);
      }
    }); 



}

const SaveDataEntryAndComplete = () =>{
    var data = 'filename='+encodeURIComponent(document.getElementById("filename").innerHTML) + "&Title="+encodeURIComponent(document.getElementById("Title").value)+"&OriginatingDate="+encodeURIComponent(document.getElementById("OriginatingDate").value)+"&Register="+encodeURIComponent(document.getElementById("Register").value)+"&Type="+encodeURIComponent(document.getElementById("Type").value)+"&Priority="+encodeURIComponent(document.getElementById("Priority").value)+"&Topic="+encodeURIComponent(document.getElementById("Topic").value)+"&Status="+encodeURIComponent(document.getElementById("Status").value)+"&StateDate="+encodeURIComponent(document.getElementById("StateDate").value)+"&Remarks="+encodeURIComponent(document.getElementById("Remarks").value);
	  var xmlhttp = new XMLHttpRequest();
	  xmlhttp.onreadystatechange=function(){
	    if (xmlhttp.readyState==4 && xmlhttp.status==200){
	    	// alert(xmlhttp.responseText);
	    	JobCompleted();

	     	// alert("Record Successfully saved!");
	    }
	  }
	  xmlhttp.open("POST","SavetoJSON.php",true);
	        //Must add this request header to XMLHttpRequest request for POST
	  xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	  
	  xmlhttp.send(data);
};

function GoldenGateIntegrator(){
  	 var Task = document.getElementById("Task").value;
     var RelevantValue = document.getElementById("RelevantValue").value;

     var chkPDFImage = document.getElementById("PDFImage");

     var isImage;


     if (chkPDFImage.checked==true){
     	isImage="YES";
     }
     else{
     	isImage=0;
     }
  	 
  	 if (Task=='CONTENTREVIEW'){
          if (RelevantValue=='Relevant'){
             $("#modal-progress").modal();
		  	 document.getElementById('response').innerHTML = "";
		     document.getElementById('response').innerHTML = "Step 1: Initializing and authenticating service...";

		  	 $.ajax({
		            type: "POST",
		            url: "https://api.innodata.com/v1.1/users/login",
		            data: JSON.stringify({ authentication_method:"password",username:"hj1@innodata.com", password:"test@1qaz" }),
		            contentType: "application/json; charset=utf-8",
		            dataType: "json",
		            success: function(result){  
		              console.log("STEP 1");
		              // console.log(result)         
                  var stringified = JSON.stringify(result);
                  var parsedObj = JSON.parse(stringified);
                // var token = parsedObj.response.api_keys.live;
                  var token = parsedObj.response.api_keys.test;
                  var Filename=document.getElementById("filename").innerHTML; 
		               step2(token,Filename,isImage);

		            },
		            failure: function(errMsg) {
		                console.log(errMsg);
		            }
		        }); 

            
          }  
          else{
          	JobCompleted();
          }
       }

 


  }

const JobRepost = () =>{
     // var chkPDFImage = document.getElementById("PDFImage");
     var isImage;
    //   if (chkPDFImage.checked==true){
   //    isImage="YES";
   //   }
   //   else{
      isImage=0;
   //   }

     $("#modal-progress").modal();
         document.getElementById('response').innerHTML = "";
         document.getElementById('response').innerHTML = "Step 1: Initializing and authenticating service...";

      $.ajax({
            type: "POST",
            url: "https://api.innodata.com/v1.1/users/login",
            data: JSON.stringify({ authentication_method:"password",username:"hj1@innodata.com", password:"test@1qaz" }),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: function(result){  
              console.log("STEP 1");
              // console.log(result)         
          var stringified = JSON.stringify(result);
            var parsedObj = JSON.parse(stringified);
            // var token = parsedObj.response.api_keys.live;
            var token = parsedObj.response.api_keys.test;
            var Filename=document.getElementById("filename").innerHTML; 
                stepRepost(token,Filename,isImage);

            },
            failure: function(errMsg) {
                console.log(errMsg);
            }
        }); 
};

const stepRepost = (token,filename,isImage) =>{
      // Upload File
      console.log("STEP 2");
        
      document.getElementById('response').innerHTML = "";
      document.getElementById('response').innerHTML = "Step 2: File uploading..." + filename;
  

    
    var data = 'data='+encodeURIComponent(token)+"&filename="+encodeURIComponent(filename)+"&isImage="+encodeURIComponent(isImage);
        var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange=function(){
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
             
            document.getElementById('response').innerHTML = xmlhttp.responseText;

            // alert(xmlhttp.responseText);
            var sText=xmlhttp.responseText;
            // window.location = "index.php";
            //  var stringified = JSON.stringify(sText);

            // var parsedObj = JSON.parse(stringified);
             sText= sText.trim();
             $('#modal-progress').modal('hide');
            location.reload();
            // step3(sText,"Ideagen-taxonomy.json",token);
            GetJobStatus();
          }
        }
        xmlhttp.open("POST","fileupload.php",true);
              //Must add this request header to XMLHttpRequest request for POST
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        
        xmlhttp.send(data);
};


const step2 = (token,filename,isImage) =>{
     // Upload File
     console.log("STEP 2");
        
     document.getElementById('response').innerHTML = "";
     document.getElementById('response').innerHTML = "Step 2: File uploading..." + filename;
 
    var data = 'data='+encodeURIComponent(token)+"&filename="+encodeURIComponent(filename)+"&isImage="+encodeURIComponent(isImage);
    var xmlhttp = new XMLHttpRequest();

        xmlhttp.onreadystatechange=function(){
          if (xmlhttp.readyState==4 && xmlhttp.status==200){
              
              document.getElementById('response').innerHTML = xmlhttp.responseText;

            // alert(xmlhttp.responseText);
            var sText=xmlhttp.responseText;
            // window.location = "index.php";
            //  var stringified = JSON.stringify(sText);

            // var parsedObj = JSON.parse(stringified);
              sText= sText.trim();
              $('#modal-progress').modal('hide');
              JobCompleted();
              location.reload();
            // step3(sText,"Ideagen-taxonomy.json",token);
    
          }
        }
       xmlhttp.open("POST","fileupload.php",true);
             //Must add this request header to XMLHttpRequest request for POST
       xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
       
       xmlhttp.send(data);
};
 

const UpdatePDFInfo = (JobID,Filename,token) =>{
    var DocType=document.getElementById("DocType");
    var jTextArea = "index";
    var data = 'data='+encodeURIComponent(JobID)+"&filename="+encodeURIComponent(Filename)+"&token="+encodeURIComponent(token);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
      if (xmlhttp.readyState==4 && xmlhttp.status==200){
        if (xmlhttp.responseText!=''){
          DocType.innerHTML=xmlhttp.responseText;
        }
        
      }
    }
    xmlhttp.open("POST","UpdatePDFInfo.php",true);
    
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    
    xmlhttp.send(data);
};
