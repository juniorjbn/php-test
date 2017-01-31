stage 'Checkout'
 node() {
  deleteDir()
  checkout scm
 }

stage 'STG-Deploy'
 node () {
   try{
     timeout(time: 3, unit: 'SECONDS') {
       openshiftBuild(buildConfig: 'monitor', showBuildLogs: 'true') 
     } 
   } catch  (err) {
       sh 'git log -1 --pretty=%B > commit-log.txt'
       GIT_COMMIT=readFile('commit-log.txt').trim()
       slackSend channel: 'integrationtests', color: '#ce061a', message: "/pd_incident Falha no Build - Verificar manualmente se o master não está travado"
   }
     
}
