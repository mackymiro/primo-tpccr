function ResequenceParagraph(){
	var Filename = document.getElementById("filename").innerHTML;
	 
	
	var strValue = editor_html.getValue();
	 
 
	editor_html.setValue("");
	// strValue=strValue.replace("'" + strSearch +"'","'" + strReplace +"'");


	 var data = 'data='+encodeURIComponent(strValue)+"&Filename="+Filename;
                 
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
          editor_html.setValue(xmlhttp.responseText);
        }
      }
      xmlhttp.open("POST","ResequenceParagraph.php",true);
            //Must add this request header to XMLHttpRequest request for POST
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send(data);

}

function RemoveTag(){
	prToggle=0;
	var strVal = editor_html.getSelection();

	a=  strVal.replace(/(<para([^>]+)>)/gi,"");
	 
	editor_html.replaceSelection(a);

}

 function enableTag(){
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
	    alert(startChar);
	    alert(endChar);
	   
	    editor_html.markText({line:cursor.line,ch:startChar},{line:cursor.line,ch:endChar+1},{readOnly:false});


	  }


	}
}





function LHeadingFlush(){
	var strVal = editor_html.getSelection();
	 
	a = "<head><headtext align=\"left\" first-line=\"0\" turnover=\"hanging\">" + strVal + "</headtext></head>";
	editor_html.replaceSelection(a);

}
function LHeadingIndented(){
	var strVal = editor_html.getSelection();
	 
	a = "<head><headtext align=\"left\" first-line=\"1\" turnover=\"hanging\">" + strVal + "</headtext></head>";
	editor_html.replaceSelection(a);

}
function FLTurnover(){
	var strVal = editor_html.getSelection();
	 
	a = "<paratext first-line=\"1\" turnover=\"1\" ID=\"p?\">" + strVal + "</paratext>";
	editor_html.replaceSelection(a);

}
function FLTurnoverHanging(){
	var strVal = editor_html.getSelection();
	 
	a = "<paratext first-line=\"1\" turnover=\"hanging\" ID=\"p?\">" + strVal + "</paratext>";
	editor_html.replaceSelection(a);

}
function FL2(){
	var strVal = editor_html.getSelection();
	 
	a = "<paratext first-line=\"2\" turnover=\"1\" ID=\"p?\">" + strVal + "</paratext>";
	editor_html.replaceSelection(a);

}
function FFL2(){
	var strVal = editor_html.getSelection();
	 
	a = "<paratext first-line=\"2\" turnover=\"2\" contd-flag=\"y\" ID=\"p?\">" + strVal + "</paratext>";
	editor_html.replaceSelection(a);

}

function FFLT2(){
	var strVal = editor_html.getSelection();
	 
	a = "<paratext first-line=\"3\" turnover=\"3\" contd-flag=\"y\" ID=\"p?\">" + strVal + "</paratext>";
	editor_html.replaceSelection(a);

}
function FLT2(){
	var strVal = editor_html.getSelection();
	 
	a = "<paratext first-line=\"2\" turnover=\"2\" ID=\"p?\">" + strVal + "</paratext>";
	editor_html.replaceSelection(a);

}
function FFLT3(){
	var strVal = editor_html.getSelection();
	 
	a = "<paratext align=\"center\" contd-flag=\"y\" ID=\"p?\">" + strVal + "</paratext>";
	editor_html.replaceSelection(a);

}
function FLT3(){
	var strVal = editor_html.getSelection();
	 
	a = "<paratext first-line=\"2\" turnover=\"3\" ID=\"p?\">" + strVal + "</paratext>";
	editor_html.replaceSelection(a);

}
function FFL2H(){
	var strVal = editor_html.getSelection();
	 
	a = "<paratext first-line=\"1\" turnover=\"1\" contd-flag=\"y\" ID=\"p?\">" + strVal + "</paratext>";
	editor_html.replaceSelection(a);

}
function FFL21(){
	var strVal = editor_html.getSelection();
	 
	a = "<paratext first-line=\"2\" turnover=\"1\" contd-flag=\"y\" ID=\"p?\">" + strVal + "</paratext>";
	editor_html.replaceSelection(a);

}
function FFL32(){
	var strVal = editor_html.getSelection();
	 
	a = "<paratext first-line=\"3\" turnover=\"2\" contd-flag=\"y\" ID=\"p?\">" + strVal + "</paratext>";
	editor_html.replaceSelection(a);

}
function FL2H(){
	var strVal = editor_html.getSelection();
	 
	a = "<paratext first-line=\"2\" turnover=\"hanging\" ID=\"p?\">" + strVal + "</paratext>";
	editor_html.replaceSelection(a);

}

function FL32(){
	var strVal = editor_html.getSelection();
	 
	a = "<paratext first-line=\"3\" turnover=\"2\" ID=\"p?\">" + strVal + "</paratext>";
	editor_html.replaceSelection(a);

}
function SmallCaps(){
	var strVal = editor_html.getSelection();
	 
	a = "<csc>" + strVal + "</csc>";
	editor_html.replaceSelection(a);

}

function CharFill(){
	var strVal = editor_html.getSelection();
	var n = strVal.length;
	var res= strVal.substring(0,1);
	var a;
	a = "<charfill numchar=\""+n+"\">" + res + "</charfill>";
	editor_html.replaceSelection(a);
}
function SmallCaps(){
	var strVal = editor_html.getSelection();
	 
	a = "<csc>" + strVal + "</csc>";
	editor_html.replaceSelection(a);

}
function Strikethrough(){
	var strVal = editor_html.getSelection();
	 
	a = "<deleted.text style=\"percent_op\">" + strVal + "</deleted.text>";
	editor_html.replaceSelection(a);

}
function ConvertParaToList(){
var strVal = editor_html.getSelection();
	var a;

	a= strVal.replace("<p>","<li>");
	a= a.replace("</p>","</li>");

	editor_html.replaceSelection(a);
}


function ConvertList(){
	var editor =CKEDITOR.instances['editor1'];
		var selectedHtml = "";
		var selection = editor.getSelection();
	 
		if (selection) {
		    selectedHtml = getSelectionHtml(selection);

		}
		 
	 	var strHTML;

	 	strHTML= selectedHtml;
	 	alert(strHTML);

}
function ConvertTableToPara(){
 
	var editor =CKEDITOR.instances['editor1'];
		var selectedHtml = "";
		var selection = editor.getSelection();
	 
		if (selection) {
		    selectedHtml = getSelectionHtml(selection);

		}
		 
	 	var strHTML;

	 	strHTML= selectedHtml;
		strHTML=  selectedHtml.replace("<tr>","##p##");
		strHTML=  strHTML.replace("</tr>","##/p##");

		strHTML=  strHTML.replace("<u>","##u##");
		strHTML=  strHTML.replace("</u>","##/u##");
		
		strHTML=  strHTML.replace("<i>","##i##");	
		strHTML=  strHTML.replace("</i>","##/i##");

		strHTML=  strHTML.replace("<b>","##b##");	
		strHTML=  strHTML.replace("</b>","##/b##");
		
		strHTML=  strHTML.replace("<table[^>]*>","");
		strHTML=  strHTML.replace("</table>","");
		strHTML=  strHTML.replace("<td"," <td");
		strHTML=  strHTML.replace("</td>","");
		strHTML=  strHTML.replace("<tbody[^>]*>","");
		strHTML=  strHTML.replace("</tbody>","");
		strHTML=  strHTML.replace(/(<([^>]+)>)/gi,"");

		strHTML=  strHTML.replace("##p##","<p>");
		strHTML=  strHTML.replace("##/p##","</p>\r\n");

		strHTML=  strHTML.replace("##u##","<u>");
		strHTML=  strHTML.replace("##/u##","</u>");
		
		strHTML=  strHTML.replace("##i##","<i>");	
		strHTML=  strHTML.replace("##/i##","</i>");
		
		strHTML=  strHTML.replace("##b##","<b>");	
		strHTML=  strHTML.replace("##/b##","</b>");
		
		 
		editor.insertHtml(strHTML);
}

function ConvertParaToTable(){
	var strVal = editor_html.getSelection();

	strVal=strVal.replace(/[\r\n]/g, '</td></tr>\r\n<tr>\r\n<td>');

	strVal=strVal.replace(/[\t]/g, '</td>\r\n<td>');

	strVal='<table>\r\n<tr>\r\n<td>' + strVal + '</td></tr>\r\n</table>'
 
	editor_html.replaceSelection(strVal);
 
}

function ConvertDiv(){
	var value = CKEDITOR.instances['editor1'].getData();
	alert(value);
 	strHTML=  value.replace(/(<(div[^>]+)>)/gi,"");
 	
	// editor_html.replaceSelection(strVal);
 	 CKEDITOR.instances.editor1.setData(strHTML); 
}

function SearchAndReplace(){
	var strSearch =document.getElementById('txtSearch').value;
	var strReplace =document.getElementById('txtReplace').value;
	
 
	
	var strValue = editor_html.getValue();
	 
 
	editor_html.setValue("");
	// strValue=strValue.replace("'" + strSearch +"'","'" + strReplace +"'");


	 var data = 'data='+encodeURIComponent(strValue + "|||" + strSearch + "|||" + strReplace);
                 
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
          editor_html.setValue(xmlhttp.responseText);
        }
      }
      xmlhttp.open("POST","ReplaceText.php",true);
            //Must add this request header to XMLHttpRequest request for POST
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send(data);

 
  
 
}
function SectionDetection(){
	
	var strValue =CKEDITOR.instances['editor1'].getData();
	 
  
	// strValue=strValue.replace("'" + strSearch +"'","'" + strReplace +"'");
	

	 var data = 'data='+encodeURIComponent(strValue);
                 
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200){
        	alert("Done!");
          	CKEDITOR.instances.editor1.setData(xmlhttp.responseText); 
        }
      }
      xmlhttp.open("POST","SectionDetection.php",true);
            //Must add this request header to XMLHttpRequest request for POST
      xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlhttp.send(data);

}