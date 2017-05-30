@title Syntax Checker
@REM This bat-file checks all php in specified folders for syntax errors.
@echo File Check Start!

@REM Foreach php file in eadesmtg/app check syntax
@ECHO Checking app directory ....
@cd D:/Xampp/htdocs/eadesmtg/app
@for /r %%v in (*.php) do @php -l -f %%v 
@echo Finished checking app directory.
@pause

@REM Foreach php file in eadesmtg/resources/views check syntax
@ECHO Checking resources/views directory ....
@cd D:/Xampp/htdocs/eadesmtg/resources/views
@for /r %%v in (*.php) do @php -l -f %%v 
@echo Finished checking resources/views directory.
@pause

@REM Foreach php file in eadesmtg/routes check syntax
@ECHO Checking routes directory ....
@cd D:/Xampp/htdocs/eadesmtg/routes
@for /r %%v in (*.php) do @php -l -f %%v 
@echo Finished checking routes directory.
@pause

@REM Foreach php file in eadesmtg/tests check syntax
@ECHO Checking routes directory ....
@cd D:/Xampp/htdocs/eadesmtg/tests
@for /r %%v in (*.php) do @php -l -f %%v 
@echo Finished checking tests directory.
@pause

@echo File Check Finished!
@pause