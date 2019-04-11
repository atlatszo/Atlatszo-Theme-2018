#!/bin/bash

DOCKER_ROOT_DIR = "$( cd "$( dirname "${BASH_SOURCE[0]}" )" >/dev/null 2>&1 && pwd )"

mkdir -p $DOCKER_ROOT_DIR/atlatszo

echo 'Downloading database...'
scp -P 22123 atlatszo@172.16.41.1:/home/atlatszo/atlatszo_front.sql $DOCKER_ROOT_DIR/atlatszo_front.sql
echo 'Done'

echo 'Downloading files...'
rsync -rvzhe "ssh -p 22123" --exclude 'wp-content/uploads' atlatszo@172.16.41.1:/data/www/production/current/wp-content $DOCKER_ROOT_DIR/atlatszo/

rsync -rvzhe "ssh -p 22123" --exclude-from 'excluded-uploads.txt' atlatszo@172.16.41.1:/data/www/production/current/wp-content/uploads $DOCKER_ROOT_DIR/atlatszo/wp-content/
echo 'Done'

echo 'Copying files to container...'
sudo rm -rf $DOCKER_ROOT_DIR/wordpress/wp-content
sudo cp -r $DOCKER_ROOT_DIR/atlatszo/wp-content $DOCKER_ROOT_DIR/wordpress/
echo 'Done'

echo 'Copying database to container...'
docker cp $DOCKER_ROOT_DIR/atlatszo_front.sql wp-latest-memcached_db1:/atlatszo_front.sql
echo 'Done'

echo 'Creating database...'
mysql -u wordpress -p -e "DROP DATABASE wordpress_test_0322"
mysql -u wordpress -p -e "CREATE DATABASE wordpress_test_0322"
echo 'Done'

echo 'Importing database...'
docker exec -it wp-latest-memcached_db1 mysql -u wordpress -p wordpress_test_0322 < atlatszo_front.sql
echo 'Done'
