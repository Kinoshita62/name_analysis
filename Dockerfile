FROM php:8.2-apache

# 日本語ロケール（任意）
RUN apt-get update && apt-get install -y \
    locales \
    && echo "ja_JP.UTF-8 UTF-8" > /etc/locale.gen \
    && locale-gen

# Apacheのmod_rewriteを有効化（必要な場合）
RUN a2enmod rewrite

# カレントディレクトリの内容を /var/www/html にコピー
COPY . /var/www/html