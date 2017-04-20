<?php
/* SaiKumar Immadi */
echo "The user used for Backing Up Database is ->myuser<-\r\n";
system("mysqldump -umyuser -p pcm > pcm_backup.sql");
?>
