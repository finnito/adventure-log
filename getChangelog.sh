#! /usr/bin/env bash

read -p "Latest tag: " firstTag
read -p "Oldest tag: " secondTag

#firstTag=$(git tag | sort -r | head -1)
#secondTag=$(git tag | sort -r | head -2 | awk '{split($0, tags, "\n")} END {print tags[1]}')
dte=$(date +"%Y/%m/%d")
printf "### ${firstTag} (${dte})\n\n"
# echo $(git log  --pretty=format:'- %s ([commit](https://github.com/finnito/adventure-log/commit/%H))%n' ${secondTag}..${firstTag})
git log  --pretty=format:'- %s ([commit](https://github.com/finnito/adventure-log/commit/%H))' ${secondTag}..${firstTag}