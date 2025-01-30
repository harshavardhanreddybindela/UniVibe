# Use the official PHP with Apache image
FROM php:apache

RUN mkdir -p /var/www/html

# Copy the content of your project into the container
COPY . /var/www/html

# Copy the entry script into the container
COPY entry.sh /entry.sh

# Set executable permissions for the entry script
RUN chmod +x /entry.sh

# Expose port 80
EXPOSE 80

# Set the entry script as the default command
CMD ["/entry.sh"]
