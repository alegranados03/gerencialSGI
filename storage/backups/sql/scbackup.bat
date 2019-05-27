@echo off
SET resultado="C:\xampp\htdocs\gerencialSGI\storage\backups\respaldos\backup_panaderia__%date:/=%_%time:~0,2%-%time:~3,2%-%time:~6,2%.sql"
cd C:/XAMPP/mysql/bin
mysqldump -u alejandro -palejandro12345A gerencialpan --result_file=%resultado%
SET respaldo="C:\xampp\htdocs\gerencialSGI\storage\backups\respaldos\last_backup.sql"
copy %resultado% %respaldo%

