stage 'Checkout'
 node() {
  deleteDir()
  checkout scm
}
stage 'slack notification'
 node () {
  sh 'git log -1 --pretty=%B > commit-log.txt'                 
  GIT_COMMIT=readFile('commit-log.txt').trim() 
  slackSend channel: 'codehip', color: '#1e602f', message: ":octocat: - BUILD_STARTED: PROJECT - ${env.JOB_NAME} - (${GIT_COMMIT})"
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
  sh 'echo Testing before promote to QA'
}
stage 'Tag to QA'
 node () {
   openshiftTag(srcStream: "phpdev", srcTag: "latest", destStream: "phpdev", destTag: "qaready")
}
stage 'QA Check'
 node () {
  openshiftVerifyDeployment(deploymentConfig: 'phpqa')
}
stage 'Approval'
 node () {
  slackSend channel: 'codehip', color: '#42e2f4', message: ":dusty_stick: - CTO - Please evaluate the Project - ${env.JOB_NAME} - http://jenkins-meu-teste.getup.io/blue/organizations/jenkins/${env.JOB_NAME}/detail/${env.JOB_NAME}/${env.BUILD_NUMBER}/pipeline/ "
  try {
    input message: 'Are this version ready for Production ?', submitter: 'juniorjbn'
  } catch(err) {
    slackSend channel: 'codehip', color: '#d80f41', message: ":finnadie: - Build (${env.BUILD_NUMBER}) from Project - ${env.JOB_NAME} - ABORTED in QA "
  }
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
   slackSend channel: 'codehip', color: '#1e602f', message: ":thumbsup_all: - UPDATE approved to production: PROJECT - ${env.JOB_NAME} - Build Number - ${env.BUILD_NUMBER} - (${GIT_COMMIT})"
}
