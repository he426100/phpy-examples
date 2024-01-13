FROM python

COPY install-php.sh .
RUN ./install-php.sh && rm install-php.sh

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sfL https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer && \
    chmod +x /usr/bin/composer && composer --version;

RUN git clone https://github.com/swoole/phpy && cd phpy && \
    phpize && \
    ./configure --with-python-config=/usr/local/bin/python-config && \
    make install && \
    echo "extension=phpy.so" > /usr/local/etc/php/conf.d/20_phpy.ini && \
    php --ri phpy && \
    composer install && composer test && \
    cd ../ && rm -r phpy;

WORKDIR /app
CMD ["/usr/local/bin/php"]
