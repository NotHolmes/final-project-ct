./vendor/bin/sail up -d
docker-compose -f ./client/docker-compose.yml up -d
docker-compose -f ./client/server/docker-compose.yml up -d

cmd.exe /c start cmd.exe /c wsl.exe docker-compose -f ./client/docker-compose.yml exec app npm run dev &
cmd.exe /c start cmd.exe /c wsl.exe docker-compose -f ./client/server/docker-compose.yml exec app npm run start 

