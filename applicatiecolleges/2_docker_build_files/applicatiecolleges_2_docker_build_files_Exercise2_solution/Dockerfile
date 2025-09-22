# Use the official OpenJDK 21 image
FROM openjdk:21-slim

# Set the working directory in the container
WORKDIR /home

# Copy the current directory contents into the container at /app
COPY ./myfiles /home
COPY ./entrypoint.sh /entrypoint.sh

# Make the entrypoint script executable
RUN chmod +x /entrypoint.sh

# Set the entrypoint script to be executed
ENTRYPOINT ["/entrypoint.sh"]