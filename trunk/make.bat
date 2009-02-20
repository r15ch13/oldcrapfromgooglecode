@echo off

for /f "tokens=2 delims=#n$" %%i in ('find "$n$" package.xml') do set var1=%%i
for /f "tokens=2 delims=#v$" %%i in ('find "$v$" package.xml') do set var2=%%i

del /f /q *.tar

cd templates
7z a -xr0@..\..\exclude.txt -ttar ..\templates.tar *

cd ..\files
7z a -xr0@..\..\exclude.txt -ttar ..\files.tar *

cd ..
7z a -xr0@..\exclude.txt -ttar "..\archive\%var1%_v%var2%.tar" *


del /f /q *.tar
exit
