<%

dim WSH,script
script = """C:\test\doc2any.exe"" ""D:\test.doc"" ""D:\out.pdf"""
Set WSH=CreateObject("WScript.Shell")
WSH.Run(script)
set WSH =nothing

%>

