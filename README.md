# Mail System using Core PHP for Multiple Users

## Overview

This project provides a basic mail system implemented in core PHP for handling email communication among multiple users within a local environment. It covers user registration, authentication, email composition, inbox management, and other essential features.

## Features

- **User Registration and Login:** Secure user registration and login functionality with password hashing.
  
- **Compose and Send Emails:** Users can compose and send emails to other registered users.
  
- **Inbox and Email Listing:** View received emails in the inbox with details such as sender, subject, and timestamp.
  
- **Read and Reply to Emails:** Read and reply to emails conveniently within the system.
  
- **Attachment Handling:** Support for attaching files to emails securely.
  
- **User Settings:** Users can manage their account settings, including password changes and personal information updates.
  
- **Security Measures:** Implementation of security best practices, including input validation and protection against common web vulnerabilities.

## Getting Started

1. Clone the repository: `https://github.com/anmrst/mailsytem.git`
2. Set up a MySQL database and import the provided SQL schema.
3. Configure the database connection in `config.php`.
4. Host the project on a PHP-enabled server.

## Usage

1. Register new users through the registration page.
2. Log in using registered credentials.
3. Compose and send emails from the "Compose" section.
4. Check and manage incoming emails in the "Inbox" section.
5. Adjust user settings in the "Account Settings" page.

## Requirements

- PHP 5.x
- MySQL
- Web server (Apache, Nginx, etc.)

## Security Considerations

- Ensure proper configuration of database connection details.
- Regularly update the system to patch security vulnerabilities.
- Validate and sanitize user inputs to prevent common web exploits.

## Contribution

Contributions are welcome! Please follow the [contribution guidelines](CONTRIBUTING.md) before submitting pull requests.

## License

This project is licensed under the [MIT License](LICENSE).

Feel free to customize this README file according to your specific project details and requirements.
