# UEMS

The university event management system is a versatile and user-friendly software solution designed to streamline the planning, organization, and execution of a wide range of events. Its primary goal is to empower institutions to orchestrate diverse events, including cultural festivals, academic conferences, sports competitions, social gatherings, seminars, and more. This system not only automates event logistics but also ensures seamless participant engagement. What sets it apart from traditional software is its userfriendly interface, robust automation capabilities, and its ability to simplify event planning and coordination for both students and faculty members.

Instructions for setting up a development environment.

To initiate the setup of a development environment for this project, follow the steps below, which outline two methods for running the project:

Method 1: Local Installation using XAMPP

1.Download Source Code.zip file from repository to your local system and unzip the zip file.

2.Install XAMPP on your machine.

3.After the installation is complete, launch XAMPP. Start both the Apache and MySQL servers from within the XAMPP application.

4.Once the servers are running, copy the unzipped folder into the following directory on your local machine: C:\xampp\htdocs\.

5.Open your web browser and enter the following address: localhost/folder-name (replace "folder-name" with the name of the folder you downloaded from the repository).

6.The project will now be accessible and operational on your local system.

By following these steps, you can successfully set up and run the project in your local development environment.

Method 2: Running the Project via Docker

1.Install Docker on your system.

2.Open PowerShell and execute the following commands:
docker pull saich019/uems-image:latest
docker network create my-network
docker run -d --name mysql-container --network my-network -e MYSQL_ALLOW_EMPTY_PASSWORD=yes -e MYSQL_DATABASE=uems mysql:latest
docker run -d --name php-container --network my-network -p 8080:80 saich019/uems-image:latest

3.Once the Apache server is running in the background, open any web browser and enter the following address: localhost:8080.

4.The project will now be accessible and functional through Docker.

By following these steps, you can effortlessly run the project using Docker, providing a convenient and containerized environment for development.
