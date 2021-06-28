start "" "%CD%\..\doc2any.exe" -killoffice 0 -useprinter "%CD%\example.docx" "%CD%\__example.docx.pdf"
start "" "%CD%\..\doc2any.exe" -killoffice 0 -useprinter "%CD%\example.doc" "%CD%\__example.doc.pdf"
start "" "%CD%\..\doc2any.exe" -multipagetif -bitcount 1 -xres 300 -yres 300 -killoffice 0 -useprinter "%CD%\example.docx" "%CD%\__example.docx.tif"
start "" "%CD%\..\doc2any.exe" -multipagetif -bitcount 1 -xres 300 -yres 300 -killoffice 0 -useprinter "%CD%\example.doc" "%CD%\__example.doc.tif"
