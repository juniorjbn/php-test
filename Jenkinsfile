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
       sh 'curl -H "Content-Type: application/json" -X POST -d \'{"service_key": "605bc544b020499a959e684ecf3ba1e2","event_type": "trigger","description": "Falha ao Gerar Build - Verificar manualmente se o master não está travado"}\' https://events.pagerduty.com/generic/2010-04-15/create_event.json'
   }
     
}
