#!/bin/sh

if [ "$#" -gt 0 ]; then
    message="$*"
else
    message="$(whoami) $(date '+%m-%d-%Y %H:%M:%S')"
fi

git add . &&
git commit -m "$message" &&
git push