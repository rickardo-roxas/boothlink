# BoothLink

## Description
BoothLink is a web-based application that allows non-students and students of Saint Louis University (SLU) to make reservations for items and services sold by SLU organizations within the campuses during events. The application demands that each booth be associated with a pre-existing organization within the campus and does not accept any attempts to put up a stall otherwise. Each organization is permitted to have several stalls. Furthermore, multiple vendor accounts can be created and associated with one or more organizations. 

## Authors and acknowledgment
- JASMIN, Ramon Emmiel
- LACANILAO, Marvin Patrick
- ROXAS, Johan Rickardo
- SICCUAN, Sebastian
- TANK, Rithik
- URBIZTONDO, Karl Jasper
- VILLAREAL, Carlo Leeon


## License
Saint Louis University License

## Project status
This project is under development.

## Installation
### Prerequisites
Before getting started, ensure that Docker is installed on your system. If Docker is not installed, follow the instructions provided in the official Docker documentation:

https://www.docker.com/products/docker-desktop/

### Setting Up the Application
1. Clone the Repository:
Clone this repository to your local machine by running the following command in your terminal:
git clone <https://gitlab.com/2233375/cs-312_boothlink.git>

2. Install Docker:
Make sure Docker is running on your machine. Open a terminal and navigate to the project directory:
cd <cs-312_boothlink>

3. Build and Run Containers:
Run the following command to build the Docker images and start the containers:
docker-compose up --build

Wait for the build process to complete. Once the images and containers are successfully built, the application will be up and running.

4. Set Up the Customer Interface:
After the containers are running, navigate to the customer directory:
cd customer

Install the required dependencies by running the following command:
npm install

### Accessing the Application
Once the application is set up and the dependencies are installed, you can access the website through the following URL:

http://localhost:3000

1. Logging In
To log in, use the following credentials:

Vendor Account:
Username: ramon
Password: ramon

Customer Account:
Username: john_doe
Password: password123