echo "rm -rf app/tmp"

rm -rf app/tmp/cache/
mkdir -p app/tmp/cache/persistent
mkdir -p app/tmp/cache/models
mkdir -p app/tmp/cache/views
mkdir -p app/tmp/logs
mkdir -p app/tmp/sessions
mkdir -p app/tmp/tests
chmod 777 app/tmp/
chmod 777 app/tmp/cache
chmod 777 app/tmp/logs
chmod 777 app/tmp/sessions
chmod 777 app/tmp/tests
chmod 777 app/tmp/cache/persistent/
chmod 777 app/tmp/cache/models/
chmod 777 app/tmp/cache/views/

if [ ! -e "app/Config/local.php" ]; then
  echo "cp app/Config/application.php app/Config/local.php"
  cp app/Config/application.php app/Config/local.php
fi

if [ ! -e "app/Config/database.php" ]; then
  echo "cp app/Config/database.php.default app/Config/database.php"
  cp app/Config/database.php.default app/Config/database.php
fi

echo "done."
