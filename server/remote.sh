#!/usr/bin/env bash
# Run a command on kpg-web over SSH and append the command + output to today's evidence log.
# Usage: server/remote.sh 'command to run on the server'
# Host, user and key come from server/.env (gitignored; see server/.env.example).
DIR="$(dirname "$0")"
set -a; . "$DIR/.env"; set +a
LOG="$DIR/logs/ssh-$(date +%F).log"
mkdir -p "$(dirname "$LOG")"
printf '\n[%s] %s@kpg-web$ %s\n' "$(date '+%F %T %Z')" "$KPG_USER" "$*" >> "$LOG"
ssh -i "${KPG_KEY/#\~/$HOME}" -o BatchMode=yes -o ConnectTimeout=15 "$KPG_USER@$KPG_HOST" "$@" 2>&1 | tee -a "$LOG"
exit "${PIPESTATUS[0]}"
