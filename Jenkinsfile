stage 'Checkout'
 node() {
  deleteDir()
  checkout scm
 }

stage 'STG-Deploy'
 node () {
   try{
     
       openshiftBuild(buildConfig: 'phpdev2', showBuildLogs: 'true') 
      
   } catch  (err) {
       sh 'git log -1 --pretty=%B > commit-log.txt'
       GIT_COMMIT=readFile('commit-log.txt').trim()
       slackSend channel: 'codehip', color: '#1e602f', message: ":thumbsup_all: - Falha no Build - Verificar manualmente se o master não está travado"
   }
     
}


stage 'slack notification'
  node () {
   slackSend channel: 'codehip', color: '#1e602f', message: ":thumbsup_all: - Tudo ok"
}
