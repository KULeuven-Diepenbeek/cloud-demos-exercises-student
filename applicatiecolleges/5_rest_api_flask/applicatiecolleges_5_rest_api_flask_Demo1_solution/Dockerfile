FROM python:3.10

WORKDIR /app

COPY ./app .

USER root
EXPOSE 5000

RUN chmod +x ./entrypoint.sh
ENTRYPOINT ["bash", "./entrypoint.sh"]
