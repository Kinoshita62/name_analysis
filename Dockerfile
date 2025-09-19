FROM php:8.2-apache

# ロケール（任意）
RUN apt-get update && apt-get install -y \
    locales \
    && echo "ja_JP.UTF-8 UTF-8" > /etc/locale.gen \
    && locale-gen

# Apacheのmod_rewrite有効化
RUN a2enmod rewrite

# PDO MySQL 拡張を追加
RUN docker-php-ext-install pdo_mysql

# アプリケーションをコピー
COPY . /var/www/html
