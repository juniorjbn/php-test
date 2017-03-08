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
       sh "curl -H \"Content-Type: application/json\" -X POST -d \'{\"service_key\": \"605bc544b020499a959e684ecf3ba1e2\",\"event_type\": \"trigger\",\"details\":\"Cliente ${env.JOB_NAME}  tente fazer outro build no jenkins e verificar se não foi apenas timeout\" ,\"description\": \"Falha ao Gerar Build - Cliente ${env.JOB_NAME} - Verificar manualmente se o master está travado\"}\' https://events.pagerduty.com/generic/2010-04-15/create_event.json"
   }
     
}
