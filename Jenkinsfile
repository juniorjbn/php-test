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
       slackSend channel: 'integrationtests', color: '#ce061a', message: ":squirrel: - Falha no Build - Verificar manualmente se o master não está travado"
       sh 'curl -H "Content-Type: application/json" -X POST -d \'{"service_key": "605bc544b020499a959e684ecf3ba1e2","event_type": "trigger","description": "FALHA - Joao Testando CURL"}\' https://events.pagerduty.com/generic/2010-04-15/create_event.json'
   }
     
}
