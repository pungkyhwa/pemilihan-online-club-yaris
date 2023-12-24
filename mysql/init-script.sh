#!/bin/bash

# Menjalankan perintah MySQL yang diinginkan
mysql -u root -ppassword -e "GRANT ALL ON KPUM.* TO 'KPUM'@'%';"
