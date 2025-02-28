#!/bin/bash

# Ejecutar php artisan serve en segundo plano
php artisan serve &

# Guardar el PID del proceso anterior
PHP_PID=$!

# Ejecutar npm run dev en segundo plano
npm run dev &

# Guardar el PID del proceso anterior
NPM_PID=$!

# Esperar a que ambos procesos terminen (esto es opcional, dependiendo de tu caso de uso)
wait $PHP_PID
wait $NPM_PID
