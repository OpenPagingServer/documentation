@echo off
setlocal

if "%~1"=="" (
    for /f "delims=" %%D in ('powershell -NoProfile -Command "Get-Date -Format 'MM-dd-yyyy HH:mm:ss'"') do set "timestamp=%%D"
    set "message=%USERNAME% %timestamp%"
) else (
    set "message=%~1"
    shift
    :next
    if not "%~1"=="" (
        set "message=%message% %~1"
        shift
        goto next
    )
)

git add . || exit /b 1
git commit -m "%message%" || exit /b 1
git push || exit /b 1
