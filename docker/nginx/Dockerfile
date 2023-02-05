ARG nginx_version=1.15
FROM nginx:${nginx_version}

ARG nginx_port=80
ENV NGINX_PORT=${nginx_port}

ARG nginx_vhost_name="_"
ENV NGINX_VHOST_NAME=${nginx_vhost_name}

COPY ./docker-entrypoint.sh /usr/local/bin
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE ${nginx_port}

ENTRYPOINT ["docker-entrypoint.sh"]
