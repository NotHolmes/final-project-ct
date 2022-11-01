./vendor/bin/sail up -d
docker-compose -f ./client/docker-compose.yml up -d
docker-compose -f ./client/server/docker-compose.yml up -d

cmd.exe /c start cmd.exe /c wsl.exe docker-compose -f ./client/docker-compose.yml exec app npm run dev 2>/tmp/null
cmd.exe /c start cmd.exe /c wsl.exe docker-compose -f ./client/server/docker-compose.yml exec app npm run start 2>/tmp/null
 
if [[ $? != 0 ]]
then

command1="docker-compose -f ./client/docker-compose.yml exec app npm run dev"
command2="docker-compose -f ./client/server/docker-compose.yml exec app npm run start"

osascript -e 'tell application "Terminal" to activate' \
  -e 'tell application "System Events" to tell process "Terminal" to keystroke "t" using command down' \
  -e "tell application \"Terminal\" to do script \"${command1};\" in selected tab of the front window"; 

osascript -e 'tell application "Terminal" to activate' \
  -e 'tell application "System Events" to tell process "Terminal" to keystroke "t" using command down' \
  -e "tell application \"Terminal\" to do script \"${command2};\" in selected tab of the front window";

fi
