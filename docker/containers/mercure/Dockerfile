FROM debian:jessie

COPY mercure.tgz /
RUN tar xzvf mercure.tgz

WORKDIR /mercure

CMD JWT_KEY="demosecretkey" ADDR="0.0.0.0:3000" ALLOW_ANONYMOUS=1 CORS_ALLOWED_ORIGINS=* ./mercure
