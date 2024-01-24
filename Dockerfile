FROM centos:6

# MAINTAINER Francisco Brujan  <fbrujan@gmail.com>

WORKDIR /var/www/inteliagencia

# Installing dependencies
COPY ./web/tools/CentOS-Base.repo /etc/yum.repos.d/

RUN yum install -y http://rpms.remirepo.net/enterprise/remi-release-6.rpm

RUN yum install -y yum-utils

RUN yum-config-manager --enable remi-php70 

RUN yum install  -y \
  httpd \
  php \
  php-mysql \
  php-pdo \
  php-mcrypt \
  php-cli \
  php-gd \
  php-curl \
  php-mysql \
  php-ldap \
  php-zip \
  php-fileinfo \
  mysql \
  crontabs

# Initials config for omega

ENV PATH=$PATH:$HOME/sbin

COPY ./web/tools/api-vhost.conf /etc/httpd/conf.d/
COPY ./web/tools/httpd.conf /etc/httpd/conf/
COPY ./web/tools/php.ini /etc/php.ini

EXPOSE 80

#  Clean up
RUN  yum clean all && \
  rm -rf /tmp/*.rpm

COPY ./web/tools/entrypoint.sh /var/www/
RUN service httpd stop
CMD ["/usr/sbin/httpd", "-D", "FOREGROUND"]

