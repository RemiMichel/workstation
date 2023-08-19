# set up cache directory acl
chmod -R 777 /cache
# install what we need to use envsubst
apt update -y
apt-get install -y gettext-base
# get ip address of the docker container
export IP=$(hostname -I)

if [ ! -d "/etc/bind/zones" ]
then
  mkdir /etc/bind/zones
fi

DOMAIN_PATH="/etc/bind/zones/db.$DOMAIN"
envsubst < /templates/db.local.net > $DOMAIN_PATH
envsubst < /templates/named.conf > /etc/bind/named.conf

/usr/sbin/named -4 -u bind -g