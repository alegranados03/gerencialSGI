@echo off
SET resultado="C:\xampp\htdocs\gerencialSGI\storage\backups\respaldos\backup_gerencialpanaderia__%date:/=%_%time:~0,2%-%time:~3,2%-%time:~6,2%.sql"
cd C:/XAMPP/mysql/bin
mysqldump -u panaderialila -pPanaderiaLilaGerencial gerencialpan --result_file=%resultado%
SET respaldo="C:\xampp\htdocs\gerencialSGI\storage\backups\respaldos\last_backup.sql"
copy %resultado% %respaldo%

