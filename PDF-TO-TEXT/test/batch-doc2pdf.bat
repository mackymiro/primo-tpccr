for %%F in (D:\downloads\Files\Files\*.xls) do ..\doc2any.exe "%%F" "%%~dpnF.pdf" >> _report.log
for %%F in (D:\downloads\Files\Files\*.doc) do ..\doc2any.exe "%%F" "%%~dpnF.pdf" >> _report.log
for %%F in (D:\downloads\Files\Files\*.ppt) do ..\doc2any.exe "%%F" "%%~dpnF.pdf" >> _report.log

