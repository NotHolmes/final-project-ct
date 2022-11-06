pipeline {
    agent any
     environment {
          HOME = '.'
     }
     stages {
          stage('Source') {
               steps {
                    git branch: 'main',
                        url: 'https://github.com/ChatchawanSama/final-project-ct-codacy.git'
               }
          }

          stage('clientSetup'){
                steps {
                    bat '''
                        cd ./client/
                        docker compose up -d
                        docker-compose exec app npm install
                        docker-compose exec app npm run dev
                    '''
               }

          }

     }
}
