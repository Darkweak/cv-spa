FROM node:alpine

WORKDIR /usr/src/client

COPY package.json yarn.lock ./
RUN set -eux; \
	yarn install

COPY . ./

VOLUME /usr/src/client/node_modules
EXPOSE 3000
RUN yarn
RUN yarn add typescript

CMD ["yarn", "start"]
