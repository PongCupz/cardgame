FROM node:12 as step01

WORKDIR /usr/src/app/my-app

COPY . /usr/src/app/my-app

RUN /bin/bash -c "npm install"
RUN /bin/bash -c "npm run build"

FROM bitnami/nginx
WORKDIR /app
COPY --from=step01 /usr/src/app/my-app/dist .