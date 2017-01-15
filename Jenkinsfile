stage 'Checkout'
 node() {
  deleteDir()
  checkout scm
 }

stage 'slack notification'
 node () {
  sh 'git log -1 --pretty=%B > commit-log.txt'                 
  GIT_COMMIT=readFile('commit-log.txt').trim() 
  slackSend channel: 'codehip', color: '#1e602f', message: "BUILD_INICIADO: PROJETO - ${env.JOB_NAME} - :octocat: (${GIT_COMMIT})"
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
  slackSend channel: 'codehip', color: '#42e2f4', message: "CTO - Favor aprovar o Build do Projeto - ${env.JOB_NAME}"
  input 'Esta versão pode ser promovida para Produção ?'
}

stage 'slack notification'
  node () {
   sh 'git log -1 --pretty=%B > commit-log.txt'
   GIT_COMMIT=readFile('commit-log.txt').trim()
   slackSend channel: 'codehip', color: '#1e602f', message: "BUILD_Terminado: PROJETO - ${env.JOB_NAME} - (${GIT_COMMIT})"
}