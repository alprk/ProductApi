###   A Symfony API which use JWT

Prerequisites : docker and docker-compose for this demo

### Installation
#### 1. Install docker and docker-compose
- If theses programms are already installed, you can go to the next step !

install docker for ubuntu : https://docs.docker.com/install/linux/docker-ce/ubuntu/

install docker-compose : https://docs.docker.com/compose/install/

#### 2. Download the repository zip

#### 3. Unzip the folder to the directory of your choice

`unzip ProductApi-master.zip ProductApi-master/`
#### 4. Go to this directory
`cd ProductApi-master/`
#### 5. Build & up docker-compose
`sudo docker-compose build`

`sudo docker-compose up`

#### 6. Create your public & private key

    sudo docker-compose exec php sh -c '
    set -e
    apk add openssl
    mkdir -p config/jwt
    jwt_passphrase=$(grep ''^JWT_PASSPHRASE='' .env | cut -f 2 -d ''='')
    echo "$jwt_passphrase" | openssl genpkey -out config/jwt/private.pem -pass stdin -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
    echo "$jwt_passphrase" | openssl pkey -in config/jwt/private.pem -passin stdin -out config/jwt/public.pem -pubout
    setfacl -R -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
    setfacl -dR -m u:www-data:rX -m u:"$(whoami)":rwX config/jwt
	'
This takes care of using the correct passphrase to encrypt the private key, and setting the correct permissions on the keys allowing the web server to read them.
    

#### 7. Create the database

    sudo docker-compose exec php bin/console doctrine:database:drop --force
	sudo docker-compose exec php bin/console doctrine:database:create
	sudo docker-compose exec php bin/console d:s:u --force

#### 7. Load the Fixtures

	sudo docker-compose exec php bin/console d:f:l


### Usage

Now your API is available at : https://localhost/8443/docs
You can have a preview of what you can do with this API.
But you are not authenticated with your JWT so you cannot see the data yet.
=> 401 : Not JWT was found

#### 1. Obtain the token

to do this, you can use the linux CLI or the Postman software which i recommend,
I will explain the linux CLI method here :

launch  :

	curl --insecure -X POST -H "Content-Type: application/json" https://localhost:8443/authentication_token -d '{"email":"user@test.com","password":"user"}'
	
-  insecure argument is to bypass the self signed certificate restriction

- This is the credential of a classic user

You will received a JsonResponse like that :



#### 2. Use the API !

Go to https://localhost/8443/docs

Click on the green "Authorize" button
Insert : Bearer token_received

The ressources are unlocked.
    
