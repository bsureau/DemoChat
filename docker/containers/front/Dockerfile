FROM node:lts-alpine as build-stage
WORKDIR /app
COPY ./front/package*.json ./
RUN npm install
COPY ./front ./
RUN npm run build

FROM debian:jessie as production-stage
RUN apt-get update && apt-get install -y nginx nginx-extras
COPY ./docker/containers/front/nginx.conf /etc/nginx/
COPY ./docker/containers/front/vhost.vuejs.conf /etc/nginx/sites-available/
RUN rm /etc/nginx/sites-enabled/default
RUN ln -s /etc/nginx/sites-available/vhost.vuejs.conf /etc/nginx/sites-enabled/vhost
COPY --from=build-stage /app/dist /var/www/project/demochat/
CMD ["nginx", "-g", "daemon off;"]
