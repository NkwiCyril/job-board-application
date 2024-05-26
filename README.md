# Opportunity Board

Welcome to the Opportunity Board application! This project is designed to help users find and manage various opportunities such as jobs, internships, and volunteerism positions. The application allows users to browse, search, and apply for opportunities, as well as manage their applications and receive notifications about new postings.

## Table of Contents

- [Features](#features)
- [Installation](#installation)
- [Usage](#usage)
- [Configuration](#configuration)
- [Contributing](#contributing)
- [Contact](#contact)

## Features

- **User Registration and Authentication**: Secure user registration and login functionality.
- **Opportunity Listings**: Browse and search for various opportunities.
- **Application Management**: Apply for opportunities.
- **Notifications**: Receive email notifications about new opportunities (registered users) and application statuses (companies).

## Installation

To get started with the Opportunity Board application, follow these steps:

1. **Clone the repository**:

    ```bash
    git clone https://github.com/NkwiCyril/seeka_opportunity-board-application.git
    ```

2. **Navigate to the project directory**:

    ```bash
    cd seeka_opportunity-board-application
    ```

3. **Install dependencies**:

    ```bash
    composer install
    npm install
    ```

4. **Set up the environment variables**:

    Rename the `.env.example` file to `.env` and configure the necessary settings, such as database credentials and mail server settings. [Mailtrap](https://mailtrap.io/) is configured as the default email testing service. 

    ```bash
    mv .env.example .env
    ```

5. **Generate an application key**:

    ```bash
    php artisan key:generate
    ```

6. **Run database migrations and seed the database**:

    ```bash
    php artisan migrate --seed
    ```

7. **Compile the assets (TailwindCSS)**:

    ```bash
    npm run dev
    ```

8. **Start the development server**:

    ```bash
    php artisan serve
    ```

## Usage

Once the application is installed and running, you can access it at `http://localhost:8000` || `http://127.0.0.1:8000/`. From there, you can register as a new user (opportunity seeker or company), browse opportunities, apply for them.
- One port can be user to work as a company and the other as an opportunity seeker.
- Company creates new opportunities and the registered opportunity seeker can apply as well as guests.

## Configuration

The `.env` file contains all the necessary configuration settings for the application. Ensure you update this file with your specific environment settings, such as database connections, mail server configurations, and third-party API keys.

## Contributing

We welcome contributions from the community! If you would like to contribute to the Opportunity Board application, please follow these steps:

1. Fork the repository.    
2. Create a new branch for your feature or bugfix.

    ```bash
    git branch -b <branch-name> 
    ```

3. Commit your changes and push the branch to your fork.

    ```bash
    git commit -m <descriptive-message>
    git push origin <branch-name>
    ```

4. Create a pull request with a detailed description of your changes.

#### Please ensure your code corresponds to the project's coding standards.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Contact

If you have any questions or feedback, please feel free to reach out:

- Email: akinimbomnkwi@gmail.com
- GitHub: [NkwiCyril](https://github.com/NkwiCyril)