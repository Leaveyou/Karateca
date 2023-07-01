FROM nginx:latest
RUN apt update
RUN apt install -y vim strace htop
COPY webserver-fpm.conf /etc/nginx/conf.d/default.conf
RUN mkdir /var/www/ && mkdir /var/www/html/ && mkdir /var/www/html/public/ && mkdir /var/www/data && chown www-data:www-data /var/www/data
RUN echo "www root volume not mounted" > /var/www/html/public/index.html
