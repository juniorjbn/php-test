#!/bin/bash

#GIT_LOG=$(git log -1 "--pretty=format:%cn %h %s")

#GIT_MSG=$(echo ${GIT_LOG// /_})

#URL=https://hooks.slack.com/services/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

#curl -v -XPOST --data-urlencode payload="{'channel': '#codehip', 'username': 'GetupBOT', 'text': 'Deploy "${OPENSHIFT_BUILD_NAME}" ("${OPENSHIFT_DEPLOYMENT_NAMESPACE}") :octocat: Commit: "${GIT_MSG}"', 'icon_emoji': ':speaking_head_in_silhouette:'}" $URL

cat > /tmp/slack_text <<EOF
{
    "text": "Please review job ${BUILD_NUMBER}",
    "channel:" "aristides"
    "username:" "GetupBOT"
    "attachments": [
        {
            "fallback": "You does not have permissions to approve",
            "callback_id": "jenkins_approval",
            "color": "#3AA3E3",
            "attachment_type": "default",
            "actions": [
                {
                    "name": "approval",
                    "text": "Approve",
                    "type": "button",
                    "value": "${BUILD_NUMBER}"
                },
                {
                    "name": "approval",
                    "text": "Decline",
                    "type": "button",
                    "value": "${BUILD_NUMBER}"
                }
            ]
        }
    ]
}
EOF

curl -X POST -H 'Content-type: application/json' \
https://hooks.slack.com/services/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 \
--data @/tmp/slack_text
