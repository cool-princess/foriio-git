shellscript.vbs
Set WinScriptHost = CreateObject("WScript.Shell")
WinScriptHost.Run Chr(34) & "F:\Practice\laravel\laravel\script.bat" & Chr(34), 0
Set WinScriptHost = Nothing