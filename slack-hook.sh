#!/bin/bash


GIT_MSG=${git log -1 "--pretty=format:%ci %cn %h %s}

curl -X POST --data-urlencode \
payload="{'channel': '#codehip', 'username': 'GetupBOT', 'text': 'Novo Deploy Realizado da aplicação : "${OPENSHIFT_BUILD_NAME}" :octocat: Gerado a partir deste commit : "${GIT_MSG}" .', 'icon_emoji': ':speaking_head_in_silhouette:'}" \
https://hooks.slack.com/services/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

