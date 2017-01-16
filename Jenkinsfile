stage 'Checkout'
 node() {
  deleteDir()
  checkout scm
 }

stage 'slack notification'
 node () {
  sh 'git log -1 --pretty=%B > commit-log.txt'                 
  GIT_COMMIT=readFile('commit-log.txt').trim() 
  slackSend channel: 'codehip', color: '#1e602f', message: ":octocat: - BUILD_INICIADO: PROJETO - ${env.JOB_NAME} - (${GIT_COMMIT})"
  slackSend channel: 'codehip', color: '#1e602f', message: "TESTE: BUILD_NUMBER ${env.BUILD_NUMBER} - BUILD_URL ${env.BUILD_URL} "
}

stage 'STG-Deploy'
 node () {
  openshiftBuild(buildConfig: 'phpdev', showBuildLogs: 'true') 
 }

stage 'STG-Check'
 node () {
  openshiftVerifyBuild(buildConfig: 'phpdev') 
 }

stage 'Tests'
 node () {
  sh 'echo testando antes de promover para Prod'
  sh 'echo checando minha Super Variavel com OC CLI'
  sh 'echo `oc env dc/devapp --list | grep SuperVar | cut -d = -f2`'
 }

stage 'Tag to QA'
 node () {
   openshiftTag(srcStream: "phpdev", srcTag: "latest", destStream: "phpdev", destTag: "qaready")
 }

stage 'QA Check'
 node () {
  openshiftVerifyDeployment(deploymentConfig: 'phpqa')
}

stage 'Aprovação'
 node () {
  slackSend channel: 'codehip', color: '#42e2f4', message: ":dusty_stick: - CTO - Favor avaliar o Build do Projeto - ${env.JOB_NAME}"
  input 'Esta versão pode ser promovida para Produção ?'
}

stage 'Tag to PROD'
 node () {
   openshiftTag(srcStream: "phpdev", srcTag: "qaready", destStream: "phpdev", destTag: "prodready")
 }

stage 'PROD Check'
 node () {
  openshiftVerifyDeployment(deploymentConfig: 'phpprod')
}

stage 'slack notification'
  node () {
   sh 'git log -1 --pretty=%B > commit-log.txt'
   GIT_COMMIT=readFile('commit-log.txt').trim()
   slackSend channel: 'codehip', color: '#1e602f', message: ":thumbsup_all: - BUILD_Terminado: PROJETO - ${env.JOB_NAME} - (${GIT_COMMIT})"
}