# Use the official OpenJDK 21 image
FROM openjdk:21-slim

# Set the working directory in the container
WORKDIR /home

# Copy the current directory contents into the container at /app
COPY ./myfiles /home

# Make the entrypoint script executable
RUN chmod +x /home/entrypoint.sh

# Set the entrypoint script to be executed
ENTRYPOINT ["/home/entrypoint.sh"]