# Workstation
_A dockerized development environment_
## Services
This is an all-in-one repository to set up a common development environment.  
It's created to be deployed on local server  

Short description :
- **Nginx** : proxy server
- **Portainer** : to manage container
- **Gitlab** : you know
- **Nextcloud**: for local cloud
- **Mysql** : Nextcloud database
- **Wireguard** : VPN server
- **Bind9** : DNS server
# How it works
## .env
Generate the .env and override the variables
```shell
cp sample.env .env
```
## Run the main stack
Run docker compose
```shell
docker compose -p workstation up -d
```
## Configurations
### MUST Override
#### For Nextcloud
| Variable | Description                                  |
|----------|----------------------------------------------|
| NEXTCLOUD_MYSQL_ROOT_PASSWORD     | MySql root password for nextcloud            |
| NEXTCLOUD_MYSQL_PASSWORD     | MySql password for nextcloud                 |
| NEXTCLOUD_SALT     | Salt for nextcloud config                    |
| NEXTCLOUD_SECRET     | Nextcloud secret                             |

#### For Bind9 DNS SERVER
| Variable | Description                              |
|----------|------------------------------------------|
| WORKSTATION_IP     | Ip of the host inside your local network |

#### For Wireguard VPN to use local Bind9 DNS
| Variable | Description                                  |
|----------|----------------------------------------------|
| BIND9_DOCKER_IP     | Bind9 container ip inside docker network     |

Once you know the ip address of your bind9 container in your docker network, you have to set the .env variable. Then recreate Wireguard container.
```shell
docker compose -p workstation up --remove-orphans --force-recreate -d --build wireguard
```
_You also may have to remove the files generated in `$WIREGUARD_HOME/config/peer<N>/*` first_

### Networking
Make sur all your services are in the same docker network.  
I use the default network of the main stack.
### SSL Certificate
Certificate local ->  [SSL Notes](https://github.com/RemiMichel/notes/blob/main/ssl.md)  
.crt and .key files must be located in 'ssl' folder under the nginx home folder  
If `NGINX_HOME_FOLDER=./nginx` the location will be **./nginx/ssl/**
### Templates
To make sur Nginx handle the .env variables, the script `loadenv.sh` run the command `envsubst` on each .template file.    
This command create a **.conf** file in **/etc/nginx/conf.d/** from **.template** files located in **/etc/nginx/templates**, with filled environment variables  

**Comment the configuration not required**  
Each service have his configuration template mounted as a volume in the docker-compose.   
Add comment in docker-compose.yml to disabled service. 
### sample.template
This is the base file used to generate .template files of services
### VPN
Generate new qrcode with wireguard.  
```shell
# Enter in the container
docker exec -it workstation-wireguard bash
# Generate the QR code
qrencode -t png -o user-qr.png -r wg-client.conf
```

### Bind9


# My Setup
## Portainer with NGiNX proxy
My main stack is composed with nginx and portainer, because i want restricted privileges through portainer on this stack and keep full privilèges on the other services.  
For that, i create a gitlab stack and nextcloud stack with portainer 
## Gitlab stack
Simple Gitlab with runner
## Nextcloud stack
Application with MySQL database.
###  Configuration
- Set up the environment variables   
- OR override `$NEXTCLOUD_HOME/application/config/config.php` once the service installed

