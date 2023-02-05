upstream fastcgi_backend {
  server php-fpm:9000;
}

server {
  listen ${NGINX_PORT};
  server_name ${NGINX_VHOST_NAME};
  root /var/www/app;

  location / {
    try_files $uri /index.php$is_args$args;
  }

  location ~ ^/index\.php(/|$) {
    fastcgi_pass fastcgi_backend;
    fastcgi_split_path_info ^(.+\.php)(/.*)$;
    include fastcgi_params;
    fastcgi_read_timeout 300;
    fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
    fastcgi_param DOCUMENT_ROOT $realpath_root;
    internal;
  }

  location ~ \.php$ {
    return 404;
  }

  error_log /var/log/nginx/project_error.log;
}
