#! /usr/bin/env bash

read -p "Latest tag: " firstTag
read -p "Oldest tag: " secondTag

dte=$(date +"%Y/%m/%d")
printf "### ${firstTag} (${dte})\n\n"
git log  --pretty=format:"- %s ([commit](https://github.com/finnito/adventure-log/commit/%H))" ${secondTag}..${firstTag}