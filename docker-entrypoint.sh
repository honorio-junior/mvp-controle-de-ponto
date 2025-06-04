#!/bin/sh

# Espera o MySQL ficar disponível na porta 3306
until nc -z -v -w30 db 3306
do
  echo "Waiting for database connection..."
  sleep 1
done

# Roda o comando que você quer após o DB estar pronto
php artisan migrate --seed

# Finalmente inicia o Apache (ou outro processo principal)
apache2-foreground
