#!/bin/bash
WWW=/var/www/omega/htdocs

# Deploy supreme App
APP_S=supreme
SRC_S=/var/www/omega/apps/$APP_S

mkdir -p $WWW/$APP_S
ln -sf $SRC_S/index.php $WWW/$APP_S/
ln -sf $SRC_S/.htaccess $WWW/$APP_S/
ln -sf $SRC_S/robots.txt $WWW/$APP_S/
ln -sf $SRC_S/robots.txt $WWW/
ln -sf $SRC_S/views/_files $WWW/$APP_S/
ln -sf $SRC_S/views/_images $WWW/$APP_S/
ln -sf $SRC_S/views/_javascript $WWW/$APP_S/
ln -sf $SRC_S/views/_styles $WWW/$APP_S/


# Deploy CRM App 
APP_C=claim
SRC_C=/var/www/omega/apps/$APP_C

mkdir -p $WWW/$APP_C
ln -sf $SRC_C/index.php $WWW/$APP_C/index.php
ln -sf $SRC_C/.htaccess $WWW/$APP_C/.htaccess

ln -sf $SRC_C/views/_files $WWW/$APP_C/
ln -sf $SRC_C/views/_images $WWW/$APP_C/
ln -sf $SRC_C/views/_styles $WWW/$APP_C/
ln -sf $SRC_C/views/_assets $WWW/$APP_C/


# Deploy PosTicket
APP_P=dealerpos
SRC_P=/var/www/omega/apps/$APP_P

mkdir -p $WWW/$APP_P
ln -sf $SRC_P/index.php $WWW/$APP_P/index.php
ln -sf $SRC_P/_htaccess $WWW/$APP_P/.htaccess
ln -sf $SRC_P/views/_files $WWW/$APP_P/
ln -sf $SRC_P/views/_images $WWW/$APP_P/
ln -sf $SRC_P/views/_styles $WWW/$APP_P/
ln -sf $SRC_P/views/_assets $WWW/$APP_P/


# /usr/sbin/httpd
service httpd start

/bin/bash
