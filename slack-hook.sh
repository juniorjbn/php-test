#!/bin/bash

GIT_LOG=$(git log -1 "--pretty=format:%cn %h %s")

GIT_MSG=$(echo ${GIT_LOG// /_})

URL=https://hooks.slack.com/services/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

curl -v -XPOST --data-urlencode payload="{'channel': '#codehip', 'username': 'GetupBOT', 'text': 'Deploy "${OPENSHIFT_BUILD_NAME}" ("${OPENSHIFT_DEPLOYMENT_NAMESPACE}") :octocat: Commit: "${GIT_MSG}"', 'icon_emoji': ':speaking_head_in_silhouette:'}" $URL

