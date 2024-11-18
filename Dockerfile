# Use the official WordPress image as the base
FROM wordpress:latest

# Install LDAP extension
RUN apt-get update && \
    apt-get install -y libldap2-dev && \
    docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/ && \
    docker-php-ext-install ldap

# Copy the CA certificate bundle into the container
COPY cacert.pem /etc/ssl/certs/cacert.pem
ENV SSL_CERT_FILE=/etc/ssl/certs/cacert.pem
