#!/bin/bash



#windows compatibility
cat /scripts/.bashrc >> /home/drg/.bashrc
dos2unix /home/drg/.bashrc

# init cron
echo "secret" | sudo -S crontab -u www-data /scripts/cron_laravel.txt
echo "secret" | sudo -S service cron start

echo "secret" | sudo update-alternatives --set php /usr/bin/php8.0

cd /app

# init apache
echo "secret" | sudo -S apache2ctl -D FOREGROUND
