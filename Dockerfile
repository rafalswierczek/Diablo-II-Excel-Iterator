FROM php:7.4-cli
COPY . /var/www/html/ExcelIterator
WORKDIR /var/www/html/ExcelIterator
CMD [ "php", "./index.php" ]