
<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
  <p align="center"><img src="Loader.gif"></p>
  <h2 align="center">Golden Gate Service</h2>
  <div id="response" align="center"></div>
   
<script type="text/javascript" src="jquery-3.4.1.min.js"></script>
<script type="text/javascript">
  $(function(){
    document.getElementById('response').innerHTML = "";
      document.getElementById('response').innerHTML = "Step 1: Initializing and authenticating service...";
   
   
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
              var token = parsedObj.response.api_keys.test;
              var Filename="SN_20200813004759.pdf"; 
               step2(token,Filename);

            },
            failure: function(errMsg) {
                console.log(errMsg);
            }
        }); 



      function step2(token,filename){
        // Upload File
        console.log("STEP 2");
        
        document.getElementById('response').innerHTML = "";
        document.getElementById('response').innerHTML = "Step 2: File uploading..." + filename;
    

      
          var data = 'data='+encodeURIComponent(token)+"&filename="+encodeURIComponent(filename);
          var xmlhttp = new XMLHttpRequest();

          xmlhttp.onreadystatechange=function(){
            if (xmlhttp.readyState==4 && xmlhttp.status==200){
               
                document.getElementById('response').innerHTML = xmlhttp.responseText;

              alert(xmlhttp.responseText);
              var sText=xmlhttp.responseText;
              // window.location = "index.php";
              //  var stringified = JSON.stringify(sText);

              // var parsedObj = JSON.parse(stringified);
               sText= sText.trim();
  
              // step3(sText,"Ideagen-taxonomy.json",token);
      
            }
          }
          xmlhttp.open("POST","GTest.php",true);
                //Must add this request header to XMLHttpRequest request for POST
          xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          
          xmlhttp.send(data);
      }

    function step3(ContentURI,taxonomy,token){
        // Post Job
        console.log("STEP 3");
        document.getElementById('response').innerHTML = "";
        document.getElementById('response').innerHTML = "Step 3: Creating Job for Data Point Extraction..." + ContentURI;

        $.ajax({  
         method: 'POST',        
        
        //url: 'http://iplcewks03261.noida.innodata.net:4000/icp2-worflow-server/api/generateXmlPdf/'+JobID+'/'+BatchId,
          url: 'https://api.innodata.com/v1.1/jobs',
          data: JSON.stringify({ "collaboration": {"teams": [{"id": "c383d5a5-4cff-473f-b820-b53bb70abb78","steps": ["*"]}]},"contents": [{"role": "input","uri": "" + ContentURI + ""}],"mapping": {"taxonomy": "" + taxonomy + ""}, type:"data-point-extraction"}),

          // data:JSON.stringify({"collaboration": {"teams": [{"name": "primoTeam","steps": ["*"]}],"users": []},"contents": [{"role": "input","uri": "" + ContentURI + ""}],"type": "pdf2xml"}),
          contentType: "application/json; charset=utf-8",
          type: "POST",
                processData: false,
                contentType: false,
                // dataType: 'text',
        beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Basic ' + btoa(token + ":" + token));
        },
        success:function(result){
          console.log(result);
          // step4(token, JobID, BatchId,filename);
        },
        failure: function(errMsg) {
            console.log(errMsg);
        }
      });
      }

      function step4(token, JobID, BatchId,filename){
        console.log("STEP 4");
        document.getElementById('response').innerHTML = "";
        document.getElementById('response').innerHTML = "Step 4: PDF Generation...";
        $.ajax({  
            method: 'GET', 
               //url: 'http://iplcewks03261.noida.innodata.net:4000/icp2-worflow-server/api/getPdfGenerationStatus/'+JobID+'/'+BatchId,
              url: 'http://virndatyp01.noida.innodata.net:7000/icp2-worflow-server/api/getPdfGenerationStatus/'+JobID+'/'+BatchId,
              type: "GET",
                    processData: false,
                    contentType: false,
            beforeSend: function (xhr) {
              xhr.setRequestHeader('Authorization', 'Bearer '+token);
            },
              success:function(result){
              console.log(result);
              if(result=="Queued"){
                setTimeout(function(){ 
                  step4(token, JobID, BatchId,filename); 
                }, 20000);
              }else if(result=="Completed"){
                step5(token, JobID, BatchId,filename);
              }
            },
            failure: function(errMsg) {
                console.log(errMsg);
            }
      });
      }

    function step5(token, JobID, BatchId,filename){
        console.log("STEP 5");
        document.getElementById('response').innerHTML = "";
        document.getElementById('response').innerHTML = "Step 5: Displaying PDF Content...";
        $.ajax({  
         method: 'GET',           
        //url: 'http://iplcewks03261.noida.innodata.net:4000/icp2-worflow-server/api/getGeneratedPdf/'+JobID+'/'+BatchId,
          url: 'http://virndatyp01.noida.innodata.net:7000/icp2-worflow-server/api/getGeneratedPdf/'+JobID+'/'+BatchId,
          type: "GET",
                processData: false,
                contentType: false,
                xhrFields: {
            responseType: 'blob'
        },
                beforeSend: function (xhr) {
            xhr.setRequestHeader('Authorization', 'Bearer '+token);
        },
        // xhrFields: {
        //     responseType: 'blob'
        // },
        success:function(result){
          // var filename = BatchId+".pdf";
            // var link=document.createElement('a');
            // link.href=window.URL.createObjectURL(result);
            // link.download= BatchId+".pdf";
            // link.click();            

            // window.navigator.msSaveOrOpenBlob(result, BatchId+".pdf");
            // var file = window.URL.createObjectURL(result);
            var formData = new FormData();
                formData.append('pdf', result);
                formData.append('filename', filename);
            $.ajax({  
              method: 'POST',           
              url: 'saveblob.php',
              type: "POST",
              data: formData,
                    processData: false,
                    contentType: false,
            success:function(x){
              console.log(x);
              // var file = window.URL.createObjectURL(result);
                  // document.querySelector("iframe").src = file;
                  window.location.href = "http://10.160.1.88/primowktaa/uploadfiles/" + filename + ".pdf";
                   //window.open("http://10.160.0.88/uploadfiles/" + filename + ".pdf");

            },
            failure: function(errMsg) {
                console.log(errMsg);
            }
          });   
            
        },
        failure: function(errMsg) {
            console.log(errMsg);
        }
      });
      }
  })
</script>
</body>
</html>