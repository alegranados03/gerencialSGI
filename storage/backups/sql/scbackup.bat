@echo off

cd C:/XAMPP/mysql/bin
mysqldump -u alejandro -palejandro12345A gerencialpan --result_file="C:\xampp\htdocs\gerencialSGI\storage\backups\backup_panaderia__%date:/=%_%time:~0,2%-%time:~3,2%-%time:~6,2%.sql"

