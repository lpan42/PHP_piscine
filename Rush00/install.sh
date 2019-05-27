# **************************************************************************** #
#                                                                              #
#                                                         :::      ::::::::    #
#    install.sh                                         :+:      :+:    :+:    #
#                                                     +:+ +:+         +:+      #
#    By: llelievr <llelievr@student.42.fr>          +#+  +:+       +#+         #
#                                                 +#+#+#+#+#+   +#+            #
#    Created: 2019/03/31 15:20:55 by llelievr          #+#    #+#              #
#    Updated: 2019/05/26 17:56:38 by llelievr         ###   ########.fr        #
#                                                                              #
# **************************************************************************** #

apt-get update
apt-get install -y php7.0 php7.0-mysql php7.0-zip php7.0-mbstring php7.0-json php7.0-fpm php7.0-curl
apt-get install -y mysql-server
mysql < /git/configs/default-user.sql
apt-get install -y curl vim htop unzip

curl --silent https://getcaddy.com | bash -s personal
chown root:root /usr/local/bin/caddy
chmod 755 /usr/local/bin/caddy

mkdir /etc/caddy
ln -s /git/configs/Caddyfile /etc/caddy/Caddyfile
chown -R root:root /etc/caddy
chmod 644 /etc/caddy/Caddyfile

mkdir /etc/ssl/caddy
chown -R root:www-data /etc/ssl/caddy
chmod 0770 /etc/ssl/caddy

mkdir /var/ft_minishop
cp -r /git/src/* /var/ft_minishop
chmod 777 -R /var/ft_minishop
chown -R www-data:www-data /var/ft_minishop

wget -q https://raw.githubusercontent.com/mholt/caddy/master/dist/init/linux-systemd/caddy.service
cp caddy.service /etc/systemd/system/
chown root:root /etc/systemd/system/caddy.service
chmod 644 /etc/systemd/system/caddy.service
systemctl daemon-reload
systemctl restart php7.0-fpm.service
systemctl restart caddy.service
systemctl enable php7.0-fpm.service
systemctl enable caddy.service

