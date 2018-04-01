FROM nginx

RUN apt-get update && \
    apt-get install -y git

ADD vhost.conf /etc/nginx/conf.d/default.conf
