..\doc2any.exe -watermarkfile "%CD%\watermark2.ini" "%CD%\example.doc" "%CD%\_out_watermark_doc2pdf1.pdf"

..\doc2any.exe -webkit -watermarkfile "%CD%\watermark2.ini" "%CD%\test-pagebreaks.htm" "%CD%\_out_watermark_html2pdf2.pdf"

..\doc2any.exe -webkit -watermarkfile "%CD%\watermark3.ini" "%CD%\test-pagebreaks.htm" "%CD%\_out_watermark_html2pdf3.pdf"

..\doc2any.exe -webkit -margin-left 10 -margin-top 20 -margin-right 10 -margin-bottom 30 -watermarkfile "%CD%\watermark3.ini" "%CD%\test-pagebreaks.htm" "%CD%\_out_watermark_html2pdf4.pdf"

pause
