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
      - traefik.http.routers.$key.entrypoints=web-secure
      - traefik.http.routers.$key.rule=Host(\`${value}\${DOMAIN}\`)
      - traefik.http.routers.$key.tls=true
      - traefik.http.routers.$key.tls.domains[0].main=\${DOMAIN}
      - traefik.http.routers.$key.tls.domains[0].sans=*.\${DOMAIN}
      - traefik.http.routers.$key.tls.certresolver=sample
"
done

echo "$text" > ./docker-compose.override.yml
