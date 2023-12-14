#!/bin/bash

# dependencies required for running "phpize"
# (see persistent deps below)
PHPIZE_DEPS=(autoconf dpkg-dev file g++ gcc libc-dev make pkg-config re2c)

# persistent / runtime deps
set -eux; \
	apt-get update; \
	apt-get install -y --no-install-recommends \
		$PHPIZE_DEPS \
		ca-certificates \
		curl \
        wget \
		xz-utils \
		; \
	rm -rf /var/lib/apt/lists/*

PHP_INI_DIR=/usr/local/etc/php

mkdir -p "$PHP_INI_DIR/conf.d"; \

PHP_VERSION=8.3.0
PHP_URL="https://www.php.net/distributions/php-8.3.0.tar.gz" 

set -eux; \
	\
	savedAptMark="$(apt-mark showmanual)"; \
	apt-get update; \
	apt-get install -y --no-install-recommends gnupg; \
	rm -rf /var/lib/apt/lists/*; \
	\
	mkdir -p /usr/src/php; \
	cd /usr/src; \
	\
	wget -c -O php.tar.gz "$PHP_URL"; \
    tar -zxvf php.tar.gz --strip-components=1 -C php;

set -eux; \
	\
	savedAptMark="$(apt-mark showmanual)"; \
	apt-get update; \
	apt-get install -y --no-install-recommends \
		libcurl4-openssl-dev \
		libonig-dev \
		libreadline-dev \
		libsodium-dev \
		libsqlite3-dev \
		libssl-dev \
		libxml2-dev \
		zlib1g-dev \
	; \
	cd /usr/src/php; \
	gnuArch="$(dpkg-architecture --query DEB_BUILD_GNU_TYPE)"; \
	debMultiarch="$(dpkg-architecture --query DEB_BUILD_MULTIARCH)"; \
	if [ ! -d /usr/include/curl ]; then \
		ln -sT "/usr/include/$debMultiarch/curl" /usr/local/include/curl; \
	fi; \
	./configure \
		--build="$gnuArch" \
		--with-config-file-path="$PHP_INI_DIR" \
		--with-config-file-scan-dir="$PHP_INI_DIR/conf.d" \
		\
		\
		--with-mhash \
		\
		--with-pic \
		\
		--enable-mbstring \
		--enable-mysqlnd \
		--with-sodium=shared \
		--with-pdo-sqlite=/usr \
		--with-sqlite3=/usr \
		\
		--with-curl \
		--with-iconv \
		--with-openssl \
		--with-readline \
		--with-zlib \
		\
		--enable-phpdbg \
		--enable-phpdbg-readline \
		\
		--with-pear \
		\
		$(test "$gnuArch" = 's390x-linux-gnu' && echo '--without-pcre-jit') \
		--with-libdir="lib/$debMultiarch" \
		\
		--enable-embed \
        --enable-dom \
        --enable-xml \
        --enable-xmlreader \
        --enable-xmlwriter \
        --enable-soap \
	; \
	make -j "$(nproc)"; \
	find -type f -name '*.a' -delete; \
	make install; \
	find \
		/usr/local \
		-type f \
		-perm '/0111' \
		-exec sh -euxc ' \
			strip --strip-all "$@" || : \
		' -- '{}' + \
	; \
	make clean; \
	\
	cp -v php.ini-* "$PHP_INI_DIR/"; \
	\
	cd ../; \
	rm -r php; \
	cd /; \
	rm -rf /var/lib/apt/lists/*; \
	\
	php --version
