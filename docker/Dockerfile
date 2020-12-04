FROM manaphp/php73:2.1

RUN  ln -f -s /usr/share/zoneinfo/PRC /etc/localtime

COPY docker/cron.d/cron /etc/cron.d/cron

COPY . /var/www/html

CMD  cron -L 15;syslogd -O /var/log/cron.log -n
