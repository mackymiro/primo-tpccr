..\doc2any.exe -width 619 -height 712 example.doc _out_5_example-wh-619x712-out.tif
..\doc2any.exe -xres 300 -yres 300 example.doc _out_5_example-res-300x300-out.tif
..\doc2any.exe -xres 300 -yres 300 -bitcount 1 -compression 4 example.doc _out_5_example-res-300x300-1bit-out.tif
..\doc2any.exe -rotate 90 example.doc _out_5_example-rotate-90-out.tif
..\doc2any.exe -producer producer -creator creator -subject subject -title title -author author -keywords keywords -openpwd 123 -ownerpwd 456 -keylen 2 -encryption 3900 example.doc _out_5_example-encryption.pdf
..\doc2any.exe -wtext "VeryPDF" -wtype 1 -wf "Arial" -walign 3 -wh 20 -wx 100 -wy 100 example.doc _out_5_example-watermark.pdf
..\doc2any.exe -useprinter example.doc _out_5_example-useprinter.pdf
