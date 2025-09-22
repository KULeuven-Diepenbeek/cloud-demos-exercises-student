FROM python:3.10

WORKDIR /app

USER root
EXPOSE 5000

COPY ./app .
COPY ./entrypoint.sh ../entrypoint.sh

RUN chmod +x ../entrypoint.sh
ENTRYPOINT ["bash", "../entrypoint.sh"]
