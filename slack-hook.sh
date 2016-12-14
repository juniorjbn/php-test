#!/bin/bash
curl -X POST --data-urlencode \
payload="{'channel': '#codehip', 'username': 'JoãoBot', 'text': 'Build terminado, iniciando deploy da Aplicação "${OPENSHIFT_BUILD_NAME}" :package:.', 'icon_emoji': ':speaking_head_in_silhouette:'}" \
https://hooks.slack.com/services/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
