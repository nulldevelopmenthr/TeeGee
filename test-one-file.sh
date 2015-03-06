#!/bin/sh
clear 

class_name=$( sed -ne "s/^class \([^ ]*\).*/\1/p" $1)

echo $class_name

for mLine in `rgrep -il --include '*Test.php' $class_name src/`
do
  report=$(./vendor/bin/phpunit --strict $mLine  )
  RESULT=$?
  #if [ $RESULT -eq 0 ]; then
  #  report=$( echo "$report" | tail -1 )
  #fi
  echo "$report"
done

for mLine in `rgrep -il --include '*Spec.php' $class_name spec/`
do
  report=$(./vendor/bin/phpspec run $mLine  )
  RESULT=$?
  echo "$report"
done


./vendor/bin/phpmd $1 text phpmd.xml
./vendor/bin/phpcs --standard=phpcs.xml $1 -n
#php tmp/php-cs-fixer.phar fix $1 --dry-run --diff --level=symfony --fixers=-unused_use,-empty_return
#php tmp/php-cs-fixer.phar fix $1 --level=symfony --fixers=-unused_use,-empty_return
