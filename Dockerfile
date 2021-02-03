FROM codeception/codeception:latest

ENV COMPOSER_ALLOW_SUPERUSER=1

# Prepare application
WORKDIR /repo

# Install modules
RUN composer require --no-update \
testomatio/reporter && \
composer update --no-dev --prefer-dist --no-interaction --optimize-autoloader --apcu-autoloader

ENV PATH /repo:${PATH}
ENTRYPOINT ["codecept"]

# Prepare host-volume working directory
WORKDIR /project
