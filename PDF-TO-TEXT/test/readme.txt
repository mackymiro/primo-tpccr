C:\>doc2any.exe
Product Name: VeryDOC DOC to Any Converter Command Line
Web: http://www.verydoc.com/
Email: support@verydoc.com
Build: Apr 13 2016
Description: Convert between document formats.
Convert *.DOC, *.DOCX, *.RTF, *.TXT, *.PPT, *.PPTX, *.XLS, *.XLSX, *.XLSB, *.CSV files to PDF, PS, EPS, SVG, SWF, XPS, HPGL, PCL, TIF, PNG, JPG, BMP, GIF, TGA, PCX, EMF, WMF, etc. formats
Standard Paper Size: http://www.verypdf.com/artprint/document-converter/index.htm
Usage: doc2any [options] <in-file> [<out-file>]
  -useoffice <int>           : Use MS Office to render DOC,DOCX,RTF,TXT,PPT,PPTX,PPTS,PPTSX,XLS,XLSX formats
    -useoffice 0: Don't use MS Office to convert DOC,DOCX,RTF,TXT,PPT,PPTX,XLS,XLSX formats
    -useoffice 1: Use MS Office to convert DOC,DOCX,RTF,TXT,PPT,PPTX,XLS,XLSX formats
  -useprinter                : Convert DOC files to other formats via virtual printer
  -useopenoffice             : Only use OpenOfice to convert office documents to PDF files
  -nooffice                  : Don't use MS Office and OpenOffice at all, use VeryPDF's Document analysis technologies
  -multipagetif              : Create multipage TIFF format
  -showofficeui              : Show Office Windows during conversion
  -silentprint               : Print office documents silently
  -printerpaper <string>     : Set the paper to target printer
  -resetofficeview           : Reset Office View type to wdPrintView
  -resetofficepage           : Reset Office Paper type to A4 paper
  -password <string>         : Set open password for office documents
  -checkpwd                  : Check if MS Word document contains an open password
  -noretry                   : Don't try to re-convert failed office documents
  -delay <int>               : Delay some milliseconds before conversion
  -width <int>               : Set page width to PDF or image file
  -height <int>              : Set page height to PDF or image file
  -bwidth <int>              : Set web browser's width for HTML conversion
  -bheight <int>             : Set web browser's height for HTML conversion
  -emfheight <int>           : Split a long HTML file by height
  -pageheight <int>          : Split a long HTML page by page height, same as -emfheight
  -pageh <int>               : same as -pageheight
  -ph <int>                  : same as -pageheight
  -fitpageforemf             : Scale EMF page contents to fit the PDF paper automatically
  -fitpageforoffice          : Scale MS Office page contents to fit printer's paper automatically
  -xres <int>                : Set X resolution to image file
  -yres <int>                : Set Y resolution to image file
  -bitcount <int>            : Set color depth for image conversion
  -compression <int>         : Set compression for TIFF image
    -compression 1     : NONE compression
    -compression 2     : CCITT modified Huffman RLE
    -compression 3     : CCITT Group 3 fax encoding (1d)
    -compression 4     : CCITT Group 4 fax encoding
    -compression 5     : LZW compression
    -compression 6     : OJPEG compression
    -compression 7     : JPEG DCT compression
    -compression 32773 : PACKBITS compression
    -compression 32809 : THUNDERSCAN compression
    -compression 88880 : 204x98  G4 ClassF TIFF
    -compression 88881 : 204x196 G4 ClassF TIFF
    -compression 88882 : 204x98  G3 ClassF TIFF
    -compression 88883 : 204x196 G3 ClassF TIFF
    -compression 88884 : CCITT Group 3 fax encoding (2d)
  -rotate <int>              : Rotate pages, 90, 180, 270
  -margin <string>           : Set page margin to PDF file
    -margin 10         : Set margin to 10pt to left
    -margin 10x10      : Set margin to 10pt to left,top
    -margin 10x10x10   : Set margin to 10pt to left,top,right
    -margin 10x10x10x10: Set margin to 10pt to left,top,right,bottom
  -pagelayout <int>          : Set page layout that is used when opening the document in Adobe Reader
   -pagelayout 0: Use viewer's default settings
   -pagelayout 1: SinglePage
   -pagelayout 2: OneColumn
   -pagelayout 3: TwoColumnLeft
   -pagelayout 4: TwoColumnRight
   -pagelayout 5: TwoPageLeft
   -pagelayout 6: TwoPageRight
  -viewpagemode <int>        : Set page mode that is used when opening the document in Adobe Reader
    -viewpagemode 0: No page mode is applied, default option
    -viewpagemode 1: Show outline tree
    -viewpagemode 2: Show thumbnails
    -viewpagemode 3: Open the document in full-screen mode
    -viewpagemode 4: UseOC
    -viewpagemode 5: UseAttachments
  -vieweropt <int>           : Set viewer preferences to Adobe Reader
    -vieweropt  1: HideToolBar
    -vieweropt  2: HideMenuBar
    -vieweropt  4: HideWindowUI
    -vieweropt  8: FitWindow
    -vieweropt 16: CenterWindow
    -vieweropt 32: DisplayDocTitle
    -vieweropt 64: Non-FullScreenPageMode, use -viewerval to set more options
  -viewerval <int>           : Additional values used by -vieweropt 64
    -vieweropt 64 -viewerval 1   : UseNone
    -vieweropt 64 -viewerval 2   : UseOutlines
    -vieweropt 64 -viewerval 4   : UseThumbs
    -vieweropt 64 -viewerval 1024: UseOC
  -viewerzoom <string>       : Set viewer zoom ratio to Adobe Reader
    -viewerzoom FitBH: Display pages to fit the width of its bounding box
    -viewerzoom FitH : Display pages to fit the width of page
    -viewerzoom Fit  : Display pages to fit window
    -viewerzoom FitV : Display pages to fit height of page
    -viewerzoom FitB : Display pages to fit its bounding box entirely
    -viewerzoom FitBV: Display pages to fit height of its bounding box
    -viewerzoom 25   : Display pages with magnification at 25%%
    -viewerzoom 50   : Display pages with magnification at 50%%
    -viewerzoom 1600 : Display pages with magnification at 1600%%
  -viewpage <string>         : set start page when opening it in Adobe Reader
  -view                      : View PDF file after creation
  -append <int>              : Append document to an existing PDF file
    -append 0: Overwrite if PDF file exists
    -append 1: Insert before first page if PDF file exists
    -append 2: Append to last page if PDF file exists
    -append 3: Rename filename if PDF file exists
  -pdfver <string>           : Set 'version number' to PDF file
    -pdfver  0: Generate PDF 1.0 file
    -pdfver  1: Generate PDF 1.1 file
    -pdfver  2: Generate PDF 1.2 file
    -pdfver  3: Generate PDF 1.3 file
    -pdfver  4: Generate PDF 1.4 file
    -pdfver  5: Generate PDF 1.5 file
    -pdfver  6: Generate PDF 1.6 file
    -pdfver  7: Generate PDF 1.7 file
    -pdfver  8: Generate PDF 1.8 file
    -pdfver  9: Generate PDF 1.9 file
    -pdfver 10: Generate PDF/X-1a:2001 file
    -pdfver 11: Generate PDF/X-1a:2002 file
    -pdfver 12: Generate PDF/X-3:2002 file
    -pdfver 13: Generate PDF/X-3:2003 file
    -pdfver 14: Generate PDF/A-1b 2005 file
  -producer <string>         : Set 'producer' to PDF file
  -creator <string>          : Set 'creator' to PDF file
  -subject <string>          : Set 'subject' to PDF file
  -title <string>            : Set 'title' to PDF file
  -author <string>           : Set 'author' to PDF file
  -keywords <string>         : Set 'keywords' to PDF file
  -openpwd <string>          : Set 'open password' to PDF file
  -ownerpwd <string>         : Set 'owner password' to PDF file
  -keylen <int>              : Key length (40 or 128 bit)
    -keylen 0:  40 bit RC4 encryption (Acrobat 3 or higher)
    -keylen 1: 128 bit RC4 encryption (Acrobat 5 or higher)
    -keylen 2: 128 bit RC4 encryption (Acrobat 6 or higher)
  -encryption <int>          : Restrictions
    -encryption    0: Encrypt the file only
    -encryption 3900: Deny anything
    -encryption    4: Deny printing
    -encryption    8: Deny modification of contents
    -encryption   16: Deny copying of contents
    -encryption   32: No commenting
    ===128 bit encryption only -> ignored if 40 bit encryption is used
    -encryption  256: Deny FillInFormFields
    -encryption  512: Deny ExtractObj
    -encryption 1024: Deny Assemble
    -encryption 2048: Disable high res. printing
    -encryption 4096: Do not encrypt metadata
  -unicode                   : Enable Unicode conversion
  -noempty                   : Delete empty pages from PDF file
  -pagerange <string>        : Set page range for conversion, eg: 1,2-4,6
  -pagecount                 : Get page count from input document
  -killoffice <int>          : Kill or not kill MS Office instances before conversion
  -installprinter            : Install virtual printer only
  -printername <string>      : Alternate name for virtual printer on FILE: port
  -printername2 <string>     : Alternate name for virtual printer on LPT1: port
  -webkit                    : Use Webkit Engine to render HTML file or URL to PDF file
  -webkit2                   : Use Webkit Engine #2 to render HTML file or URL to PDF file
  -margin-left <int>         : Set the page left margin (default 10mm)
  -margin-top <int>          : Set the page top margin (default 10mm)
  -margin-right <int>        : Set the page right margin (default 10mm)
  -margin-bottom <int>       : Set the page bottom margin (default 10mm)
  -minimum-font-size <int>   : Minimum font size (default 5)
  -swfopt <string>           : set SWF options
    -z : Use Flash 6 (MX) zlib compression
         e.g. : -swfopt "-z"
    -p <range>: Convert only pages in range with range
         e.g. 1-20 or 1,4,6,9-11 or 3-5,10-12
    -i : Allows PDF to Flash to change the draw order of the PDF. This may make
         the generated SWF files a little bit smaller
    -j <quality>: Set quality of embedded jpeg pictures to quality. 0 is worst
         (small), 100 is best (big). (default:85)
         e.g. : -swfopt "-j 50"
    -S : Don't use SWF Fonts, but store everything as shape
    -f : Store all fonts into SWF
    -t : Insert a 'stop' command after each page. The resulting SWF file will
         not turn pages automatically.
    -s zoom=factor : Set resolution to SWF file, default: 72DPI
  -pdfquality <int>          : Set quality which is used to compress images in PDF file
  -wtext <string>            : Watermark text on printed document
    -wtext does support following dynamic values:
    %PageCount%, %PageNumber%, %PageCountRoman%, %PageCountRoman2%,
    %PageNumberRoman%, %PageNumberRoman2%, %Author%, %Keywords%,
    %Subject%, %Title%, %Filename%, %Date%, %Time%
  -wtype <int>               : type of watermark
    0 : normal watermark
    1 : watermark on header
    2 : watermark on footer
  -wf <string>               : font name of watermark
  -wh <int>                  : font size of watermark
  -wb                        : specify bold font
  -wi                        : specify an italic font
  -wu                        : specify an underlined font
  -ws                        : specify a strikeout font
  -wa <int>                  : angle of watermark
  -wbox <string>             : a rectangle to output formatted text, it is only useful for "-walign" option, eg:
    -wbox "0,0,595,842"
    -wbox "0,0,612,792"
    -wbox "auto"
  -walign <int>              : set text align
    1 : left
    2 : center
    3 : right
  -wc <string>               : color of watermark,
    FF0000: Red color
    00FF00: Green color
    0000FF: Blue color
    HexNum: Other colors
  -wx <int>                  : X offset of watermark
  -wy <int>                  : Y offset of watermark
  -wpagebegin <int>          : first page to add the watermark
  -wpageend <int>            : last page to add the watermark
  -wpageoffset <int>         : a value to be added to page number
  -watermarkfile <string>    : a .ini file which contain information for multiple watermarks
  -svgnoclip                 : remove clipping during SVG output
  -svgscale <fp>             : Scale the elements in SVG file, default is 1.0
  -timeoutkillself <int>     : specify a timeout to avoid hanging doc2any process, in millisecond
  -log <string>              : output log into a file
  -debug                     : Print log message on screen
  -runasuser <string>        : Run current EXE application from a user account
  -runaspwd <string>         : Password of specified user account
  -runviaservice             : Pass conversion job to docPrint_Service.exe and wait until it be finished completely
  -port <int>                : port number used to avoid multiple instances, default is 65000
  -parent <int>              : Reserved parameter
  -call                      : Reserved parameter
  -arg <string>              : Reserved parameter
  -nortfsdk                  : Reserved parameter
  -v                         : Print copyright and version info
  -h                         : Print usage information
  -help                      : Print usage information
  --help                     : Print usage information
  -?                         : Print usage information
  -$ <string>                : Input registration key
Example:
   doc2any.exe C:\in.doc C:\out.pdf
   doc2any.exe C:\in.ppt C:\out.pdf
   doc2any.exe C:\in.xls C:\out.pdf
   doc2any.exe C:\in.docx C:\out.pdf
   doc2any.exe C:\in.pptx C:\out.pdf
   doc2any.exe C:\in.xlsx C:\out.pdf
   doc2any.exe C:\*.doc C:\*.pdf
   doc2any.exe -margin 100x100x100x100 C:\in.rtf C:\out.pdf
   doc2any.exe -append 2 -width 612 -height 792 C:\*.doc C:\out.pdf
   doc2any.exe -append 2 C:\*.doc C:\out.pdf
   doc2any.exe -width 612 -height 792 C:\in.doc C:\out.pdf
   doc2any.exe -append 1 C:\in.doc C:\out.pdf
   doc2any.exe -append 2 C:\in.doc C:\out.pdf
   doc2any.exe -subject "subject" C:\in.doc C:\out.pdf
   doc2any.exe -ownerpwd 123 -keylen 2 -encryption 3900 C:\in.doc C:\out.pdf
   doc2any.exe -pdfver 7 C:\in.doc C:\out.pdf
   doc2any.exe "C:\in.doc" C:\out.gif
   doc2any.exe "C:\in.doc" C:\out.png
   doc2any.exe -useprinter -xres 300 -yres 300 -bitcount 1 -compression 4 "C:\in.doc" "C:\out.tif"
   doc2any.exe -useoffice 1 -useprinter -showofficeui "C:\in.doc" "C:\out.pdf"
   doc2any.exe -printerpaper "3000x3000pt" -useoffice 1 -useprinter in.xls out.pdf
   doc2any.exe -printerpaper "8.5x11in" -useoffice 1 -useprinter in.xls out.pdf
   doc2any.exe -printerpaper "612x792pt" -useoffice 1 -useprinter in.xls out.pdf
   doc2any.exe -printerpaper "297x420mm" -useoffice 1 -useprinter in.xls out.pdf
   doc2any.exe -printerpaper "210x297mm" -useoffice 1 -useprinter in.xls out.pdf
   doc2any.exe -printerpaper 66 -useoffice 1 -useprinter in.xls out.pdf
   doc2any.exe -printerpaper 8 -useoffice 1 -useprinter in.xls out.pdf
   doc2any.exe -useprinter -useoffice 1 -showofficeui -delay 10000 -resetofficeview -debug "C:\in.doc" "C:\out.pdf"
   doc2any.exe -useoffice 1 -useprinter -delay 5000 "C:\in.doc" "C:\out.pdf"
   doc2any.exe -killoffice 0 -useprinter "C:\in.doc" C:\out.pdf
   doc2any.exe -multipagetif -killoffice 0 -useprinter "C:\in.doc" C:\out.tif
   doc2any.exe -multipagetif -bitcount 1 -xres 300 -yres 300 -killoffice 0 -useprinter "C:\in.doc" C:\out.tif
   doc2any.exe -useprinter -compression 88880 "C:\in.doc" C:\out.tif
   doc2any.exe -useprinter -compression 88881 "C:\in.doc" C:\out.tif
   doc2any.exe -useprinter -compression 88883 "C:\in.doc" C:\out.tif
   doc2any.exe -multipagetif -useprinter -compression 88880 "C:\in.doc" C:\out.tif
   for %F in (D:\test\*.doc) do "doc2any.exe" "%F" "%~dpnF.pdf"
   for /r D:\test %F in (*.doc) do "doc2any.exe" "%F" "%~dpnF.pdf"
   doc2any.exe -useprinter -useoffice 1 -noretry -password 123456 D:\test.docx D:\out.pdf
   doc2any.exe -useoffice 1 -checkpwd -noretry D:\test.docx D:\out.pdf
   doc2any.exe -viewerzoom 1600 -viewpage 10 -viewpagemode 2 -view "C:\in.doc" C:\out.pdf
   doc2any.exe -useprinter "C:\example.odt" "C:\openofficedoc.pdf"
   doc2any.exe "C:\example.odt" "C:\openofficedoc.pdf"
   doc2any.exe -installprinter -printername myprinter1 -printername2 myprinter2
   doc2any.exe -width 800 "C:\test.doc" "C:\test.jpg"
   doc2any.exe -height 800 "C:\test.doc" "C:\test.jpg"
   doc2any.exe "C:\test.doc" "C:\out%.swf"
   doc2any.exe "C:\test.ppt" "C:\slide%.swf"
   doc2any.exe -swfopt "-j 100" "C:\test.ppt" "C:\slide%.swf"
   doc2any.exe -useoffice 1 "C:\test.docx" "C:\test.htm"
   doc2any.exe -useprinter -pagerange "2-3" "C:\test.docx" "C:\test.htm"
   doc2any.exe -useprinter -pagerange "2,4-6,8-" "C:\test.docx" "C:\test.htm"
   doc2any.exe -killoffice 1 -timeoutkillself 5000 C:\in.docx C:\out.pdf

Convert documents to PDF and other formats using OpenOffice ONLY (ignore MS Office):
   doc2any.exe -useopenoffice "C:\test.doc" "C:\out.pdf"
   doc2any.exe -useopenoffice "C:\test.docx" "C:\out.pdf"
   doc2any.exe -useopenoffice "C:\test.xls" "C:\out.pdf"
   doc2any.exe -useopenoffice "C:\test.xlsx" "C:\out.pdf"
   doc2any.exe -useopenoffice "C:\test.ppt" "C:\out.pdf"
   doc2any.exe -useopenoffice "C:\test.pptx" "C:\out.pdf"
   doc2any.exe -useopenoffice "C:\test.doc" "C:\out.html"
   doc2any.exe -useopenoffice "C:\test.docx" "C:\out.html"
   doc2any.exe -useopenoffice "C:\test.xls" "C:\out.html"
   doc2any.exe -useopenoffice "C:\test.xlsx" "C:\out.html"
   doc2any.exe -useopenoffice "C:\test.ppt" "C:\out.html"
   doc2any.exe -useopenoffice "C:\test.pptx" "C:\out.html"
   doc2any.exe -useopenoffice "C:\test.docx" "C:\out.doc"

Add watermarks into PDF files:
   doc2any.exe -wtext "VeryPDF" "C:\in.doc" C:\out.pdf
   doc2any.exe -wtext "VeryPDF" -wc "0000FF" "C:\in.doc" C:\out.pdf
   doc2any.exe -wtext "VeryPDF" -wx 100 -wy 100 "C:\in.doc" C:\out.pdf
   doc2any.exe -wtext "VeryPDF" -wtype 1 "C:\in.doc" C:\out.pdf
   doc2any.exe -wtext "VeryPDF" -wtype 2 "C:\in.doc" C:\out.pdf
   doc2any.exe -wtext "VeryPDF" -wtype 0 -wa 45 "C:\in.doc" C:\out.pdf
   doc2any.exe -wtext "VeryPDF" -wf "Arial" "C:\in.doc" C:\out.pdf
   doc2any.exe -wtext "VeryPDF" -wf "Arial" -wh 20 "C:\in.doc" C:\out.pdf
   doc2any.exe -wtext "VeryPDF" -wf "Arial" -wh 20 -wb -wi -wu -ws "C:\in.doc" C:\out.pdf
   doc2any.exe -wtext "VeryPDF" -wf "Arial" -walign 3 -wh 20 -wbox "0,770,612,792" "C:\in.doc" C:\out.pdf
   doc2any.exe -wtext "Watermark %PageNumber% of %PageCount%" "C:\in.doc" C:\out.pdf
   doc2any.exe -wtext "Watermark %PageNumber% of %PageCount%" -wpagebegin 10 -wpageend 20 -wpageoffset 100 "C:\in.doc" C:\out.pdf
   doc2any.exe -wtext "Watermark %PageNumberRoman% of %PageCountRoman%" "C:\in.doc" C:\out.pdf
   doc2any.exe -wtext "Watermark %PageNumberRoman2% of %PageCountRoman2%" "C:\in.doc" C:\out.pdf
   doc2any.exe -wtext "Watermark %PageNumber% of %PageCount%" -walign 3 -wtype 1 "C:\in.doc" C:\out.pdf
   doc2any.exe -wtext "Watermark %PageNumber% of %PageCount%" -walign 2 -wtype 2 "C:\in.doc" C:\out.pdf
   doc2any.exe -wtext "%Filename% %Date% %Time% %PageNumber% of %PageCount%" "C:\in.doc" C:\out.pdf

Convert documents to PDF files via Doc2Any Service (You need run "doc2any_service/docPrint_Service.exe" first):
   doc2any.exe -runviaservice "D:\test.docx" "D:\test.pdf"

Convert office documents to PDF and other formats without use OpenOffice and MS Office:
   doc2any.exe does support following format conversions without depend on MS Office, OpenOffice and libreoffice applications
   =================================================
   HTML to RTF  [OK], HTML to DOC [OK], HTML to DOCX [OK], HTML to PDF [OK]
    RTF to HTML [OK],  RTF to DOC [OK],  RTF to DOCX [OK],  RTF to PDF [OK]
    DOC to HTML [OK],  DOC to RTF [OK],  DOC to DOCX [OK],  DOC to PDF [OK]
   DOCX to HTML [OK], DOCX to RTF [OK], DOCX to DOC  [OK], DOCX to PDF [OK]
    ODT to HTML [OK],  ODT to RTF [OK],  ODT to DOCX [OK],  ODT to PDF [OK]
    DOT to HTML [OK],  DOT to RTF [OK],  DOT to DOCX [OK],  DOT to PDF [OK]
    OTT to HTML [OK],  OTT to RTF [OK],  OTT to DOCX [OK],  OTT to PDF [OK]
   =================================================
   DOTX to HTML [OK], DOTX to RTF [OK], DOTX to DOC  [OK], DOTX to DOCX [OK], DOTX to PDF [OK]
   DOCM to HTML [OK], DOCM to RTF [OK], DOCM to DOC  [OK], DOCM to DOCX [OK], DOCM to PDF [OK]
   DOTM to HTML [OK], DOTM to RTF [OK], DOTM to DOC  [OK], DOTM to DOCX [OK], DOTM to PDF [OK]
   =================================================
    XLS to HTML [OK],  XLS to PDF [OK],  XLS to CSV  [OK],  XLS to XLSX [OK],  XLS to ODS  [OK]
   XLSX to HTML [OK], XLSX to PDF [OK], XLSX to CSV  [OK], XLSX to XLS  [OK], XLSX to ODS  [OK]
    ODS to HTML [OK],  ODS to PDF [OK],  ODS to CSV  [OK],  ODS to XLS  [OK],  ODS to XLSX [OK]
    CSV to HTML [OK],  CSV to PDF [OK],  CSV to XLS  [OK],  CSV to XLSX [OK],  CSV to ODS  [OK]
   =================================================
   doc2any.exe -nooffice "C:\test.doc" "C:\out.pdf"
   doc2any.exe -nooffice "C:\test.docx" "C:\out.pdf"
   doc2any.exe -nooffice "C:\test.xls" "C:\out.pdf"
   doc2any.exe -nooffice "C:\test.xlsx" "C:\out.pdf"
   doc2any.exe -nooffice "C:\test.ppt" "C:\out.pdf"
   doc2any.exe -nooffice "C:\test.pptx" "C:\out.pdf"
   doc2any.exe -nooffice "C:\test.doc" "C:\out.html"
   doc2any.exe -nooffice "C:\test.docx" "C:\out.html"
   doc2any.exe -nooffice "C:\test.xls" "C:\out.html"
   doc2any.exe -nooffice "C:\test.xlsx" "C:\out.html"
   doc2any.exe -nooffice "C:\test.ppt" "C:\out.html"
   doc2any.exe -nooffice "C:\test.pptx" "C:\out.html"
   doc2any.exe -nooffice "C:\test.docx" "C:\out.doc"

Convert HTML file or URL to PDF with IE, Webkit and Office Engines:
   doc2any.exe http://www.verydoc.com/ C:\out.pdf
   doc2any.exe http://www.google.com/ C:\out.pdf
   doc2any.exe -webkit http://www.verydoc.com/ C:\out.pdf
   doc2any.exe -webkit http://www.google.com/ C:\out.pdf
   doc2any.exe -useoffice 1 -useprinter http://www.verydoc.com/ C:\out.pdf
   doc2any.exe -webkit -width 595 -height 842 -minimum-font-size 20 -margin-left 20 -margin-top 20 -margin-right 20 -margin-bottom 20 "http://www.verypdf.com" D:\out.pdf
   


Supported file types:
---------------------

The following file types can be converted:

 * Word       - .doc, .dot,  .docx, .dotx, .docm, .dotm, .rtf, .odt
 * Excel      - .xls, .xlsx, .xlsm, .csv, .odc
 * Powerpoint - .ppt, .pptx, .pptm, .pps, .ppsx, .ppsm, .odp
 * Visio      - .vsd, .vsdm, .vsdx [.vsdm and .vsdx require Visio >= 2013]
 * Publisher  - .pub
 * Outlook    - .msg, .vcf, .ics
 * Project    - .mpp [requires Project >= 2010]
 * Image      - .bmp, .jpg, .tif, .png, .pcx, .tga, .psd, .gif, .ico, etc.

