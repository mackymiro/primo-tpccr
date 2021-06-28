:retry
for %%F in (D:\*.doc) do (
"..\doc2any.exe" "%%F" "D:\%%~nxF.pdf"
move "%%F" "%%F.bak"
)
ping -n 5 127.0.0.1 > nul
goto retry
