# Workstation
_A dockerized development environment_
## Services
This is an all-in-one repository to set up a common development environment.  
It's created to be deployed on local server  

Short description :
- **Nginx** : as proxy server
- **Portainer** : to manage container
- **Gitlab** : you know
- **Nextcloud**: for local cloud
- **Mysql** : Nextcloud database
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
The main principe is, when stacks are deployed on portainer service, you juste have to generate a .conf. Mount him as volume to nginx service. Then restart it to apply the new configuration.  
You can templating configuration file with env variables for nginx, see Templates section.
### Networking
Make sur all your services are in the same docker network.  
I use the default network of the main stack.
### SSL Certificate
Certificate generation local ->  [SSL Notes](https://github.com/RemiMichel/notes/blob/main/ssl.md)  
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

# My Setup
## Portainer with NGiNX proxy
My main stack is composed with nginx and portainer, because i want restricted privileges through portainer on this stack and keep full privilèges on the other services.  
For that, i create a gitlab stack and nextcloud stack with portainer 
## Gitlab stack
Simple Gitlab with runner
## Nextcloud stack
Application with MySQL database.

