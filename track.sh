#!/bin/sh

while :
do
  find spec/ -name "*.php" -mmin 0.051 -exec ./vendor/bin/phpspec run \;
  find src/ -name "*.php" -mmin 0.051 -exec ./test-one-file.sh {} \;
  sleep 2
done
