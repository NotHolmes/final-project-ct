pipeline {
    agent any
     environment {
          HOME = '.'
     }
     stages {
          stage('Source') {
               steps {
                    git branch: 'main',
                        url: 'https://github.com/NotHolmes/final-project-ct.git'
               }
          }

          stage('clientSetup'){
                steps {
                    bat '''
                        cd ./client/
                        docker compose up -d
                        docker-compose exec app npm install
                    '''
               }

          }

          stage('clientRun'){
                  steps {
                      bat '''
                        cd ./client/
                        docker-compose exec app npm run dev
                      '''
                 }

            }

     }
}
