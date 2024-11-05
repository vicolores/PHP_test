FROM mcr.microsoft.com/devcontainers/php:1-8.2-bookworm

# Instalar el cliente de MariaDB
RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
    && apt-get install -y mariadb-client \
    && apt-get clean -y && rm -rf /var/lib/apt/lists/*

# Instalar el driver php-mysql
RUN docker-php-ext-install mysqli pdo pdo_mysql

# [Opcional] Descomenta esta sección para instalar paquetes adicionales del sistema operativo.
# RUN apt-get update && export DEBIAN_FRONTEND=noninteractive \
#     && apt-get -y install --no-install-recommends <lista-de-paquetes-aquí>

# [Opcional] Descomenta esta línea para instalar paquetes globales de Node.
# RUN su vscode -c "source /usr/local/share/nvm/nvm.sh && npm install -g <tu-paquete-aquí>" 2>&1

# Cambiar el usuario de Apache a 'vscode'
RUN sed -i 's/www-data/vscode/g' /etc/apache2/envvars

# Asegurar que el usuario 'vscode' tiene permisos sobre /var/www/html
RUN chown -R vscode:vscode /var/www/html

# Establecer permisos adecuados
RUN chmod -R 755 /var/www/html

# Habilitar módulos necesarios de Apache y reiniciar el servicio
RUN a2enmod rewrite && a2enmod headers && service apache2 restart
