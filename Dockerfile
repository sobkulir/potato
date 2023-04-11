FROM debian:10

# Update the system and install necessary dependencies
RUN apt-get update && \
    apt-get install -y php php-mysql php-gd php-xml php-mbstring && \
    apt-get install -y net-tools openssh-server openssh-client && \
    apt-get clean && \
    apt-get install -y php-pgsql &&\
    
    rm -rf /var/lib/apt/lists/*

# Set the working directory
WORKDIR /var/www/html

# Copy the PHP project files into the container
COPY . .

# Expose port 80 for HTTP traffic
EXPOSE 80

# Start the PHP web server
CMD ["php", "-S", "0.0.0.0:80", "-t", "/var/www/html"]
