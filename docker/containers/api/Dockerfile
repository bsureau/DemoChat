FROM debian:jessie
RUN apt-get update && apt-get install -y nginx nginx-extras
COPY nginx.conf /etc/nginx/
COPY vhost.symfony.conf /etc/nginx/sites-available/
RUN rm /etc/nginx/sites-enabled/default
RUN ln -s /etc/nginx/sites-available/vhost.symfony.conf /etc/nginx/sites-enabled/vhost
CMD ["nginx", "-g", "daemon off;"]
