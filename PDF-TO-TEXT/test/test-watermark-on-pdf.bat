..\doc2any.exe -wtext "COPY" -wc "EDEDED" -wh 70 -wb -wtype 0 -useprinter -noretry -useoffice 0 "%CD%\testcmd.pdf" "%CD%\_testcmd-001.pdf"
..\doc2any.exe -watermarkfile "%CD%\watermark.ini" "%CD%\testcmd.pdf" "%CD%\_testcmd-002.pdf"
..\doc2any.exe -killoffice 0 -wtext "Copy" -wtype 0 -wh 200 -wc C0C0C0 -wa 45 "%CD%\testcmd.pdf" "%CD%\_testcmd-003.pdf"
..\doc2any.exe -watermarkfile "%CD%\watermark2.ini" "%CD%\testcmd.pdf" "%CD%\_testcmd-004.pdf"

pause
