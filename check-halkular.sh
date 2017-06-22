#!/bin/bash

#This is the "hpa-controller-token" 
TOKEN=$ENV_TOKEN

#URL used to GET a metric
RESULT=$(curl 'https://metrics.getup.io/hawkular/metrics/metrics/stats/query' -H "$TOKEN" -H 'Hawkular-Tenant: dev-getup-site' -H 'Content-Type: application/json' --data-binary '{"tags":"descriptor_name:cpu/usage_rate,type:pod_container,pod_id:2c6b0228-4dfd-11e7-a910-000d3ac02da0,container_name:php-extra","bucketDuration":"1mn","start":"-1mn"}' --write-out "%{http_code}" --silent --output /dev/null)

if [ $RESULT -gt 200 ];	then
	curl -v -XPOST --data-urlencode payload="{'channel': '#integrationtests', 'username': 'GetupBOT', 'text': 'Hawkular fail, check if metrics are being generated', 'icon_emoji': ':finnadie:'}" https://hooks.slack.com/services/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
fi