pipeline {

    agent any

    environment {
        SCANNER_HOME = tool 'SonarScanner'
    }

    stages {

        stage('Checkout') {
            steps {
                checkout scm
            }
        }

        stage('Git Version') {
            steps {
                sh 'git --version'
            }
        }

        stage('Docker Version') {
            steps {
                sh 'docker --version'
            }
        }

        stage('Docker Build') {
            steps {
                sh 'docker build -t food-app:latest .'
            }
        }

        stage('SonarQube Analysis') {
            steps {
                withSonarQubeEnv('SonarQube') {
                    sh """
                        ${SCANNER_HOME}/bin/sonar-scanner \
                        -Dsonar.projectKey=online-food-ordering-devops \
                        -Dsonar.projectName=online-food-ordering-devops \
                        -Dsonar.projectVersion=1.0 \
                        -Dsonar.sources=app
                    """
                }
            }
        }


	stage('Trivy Scan') {
    steps {
        sh '''
        trivy image \
        --severity HIGH,CRITICAL \
        --no-progress \
        food-app:latest | tee trivy-report.txt
        '''
    }
}

	stage('Docker Login') {
    steps {
        withCredentials([usernamePassword(
            credentialsId: 'dockerhub',
            usernameVariable: 'DOCKER_USER',
            passwordVariable: 'DOCKER_PASS'
        )]) {
            sh '''
            echo "$DOCKER_PASS" | docker login -u "$DOCKER_USER" --password-stdin
            '''
        }
    }
}


	stage('Push Docker Image') {
    steps {
        sh '''
            docker tag food-app:latest suryaprakash2007/food-app:latest
            docker push suryaprakash2007/food-app:latest
        '''
    }
}

        stage('Docker Images') {
            steps {
                sh 'docker images'
            }
        }

    }

}
