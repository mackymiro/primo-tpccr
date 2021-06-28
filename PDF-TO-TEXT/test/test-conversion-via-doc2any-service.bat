for %%F in ("%CD%\*.doc") do ..\doc2any.exe -runviaservice "%%F" "%%F.pdf"
for %%F in ("%CD%\*.xls") do ..\doc2any.exe -runviaservice "%%F" "%%F.pdf"
for %%F in ("%CD%\*.ppt") do ..\doc2any.exe -runviaservice "%%F" "%%F.pdf"
for %%F in ("%CD%\*.rtf") do ..\doc2any.exe -runviaservice "%%F" "%%F.pdf"

pause
