#!/usr/bin/env bash

services=("admin:admin." "api:api." "cache:cache." "mercure:mercure." "ssr:")
text="version: '3.4'
services:"

for k in "${services[@]}" ; do
    key=${k%%:*}
    value=${k#*:}
    text+="
  $key:
    labels:
      - traefik.http.middlewares.https-redirect.redirectscheme.scheme=https
      - traefik.http.middlewares.https-redirect.redirectscheme.permanent=true
      - traefik.http.routers.$key.rule=Host(\`${value}\${DOMAIN}\`)
      - traefik.http.routers.$key.entrypoints=web-secure
      - traefik.http.routers.$key.tls.certresolver=letsencrypt
"
done

echo "$text" > ./docker-compose.override.yml
