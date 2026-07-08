pipeline {

    agent any

    stages {

        stage('Checkout') {
            steps {
                echo 'Source Code Ready'
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

        stage('Docker Images') {
            steps {
                sh 'docker images'
            }
        }

    }

}
