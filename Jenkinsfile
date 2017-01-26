stage 'Checkout'
 node() {
  deleteDir()
  checkout scm
 }

stage 'STG-Deploy'
 node () {
   try{
     timeout(time: 6, unit: 'SECONDS') {
       openshiftBuild(buildConfig: 'phpdev2', showBuildLogs: 'true') 
     } 
   } catch  (err) {
       sh 'git log -1 --pretty=%B > commit-log.txt'
       GIT_COMMIT=readFile('commit-log.txt').trim()
       slackSend channel: 'codehip', color: '#1e602f', message: ":squirrel: - Falha no Build - Verificar manualmente se o master não está travado"
   }
     
}
