# Project 2: Quiz App

anmol singh

This is a PHP and MySQL quiz application for Project 2.

## Features Developed

1. Home page where the user can start the quiz.
2. Signup page so users can create an account.
3. Login and logout system.
4. Quiz page with random questions from `data/questions.json`.
5. Results page that shows the final score.
6. Saves user score, total questions, percentage, and date into MySQL.
7. Profile page where users can view their play history.
8. Leaderboard page that shows the top 10 players.
9. Timer for the quiz.
10. User can choose 10, 15, or 20 questions.
11. User can replay/restart after finishing.

## How to Run the Server Locally

1. Put the `quiz-app` folder inside your local server folder.

AMPPS example:

```text
C:\Ampps\www\quiz-app
```

XAMPP example:

```text
C:\xampp\htdocs\quiz-app
```

2. Start Apache and MySQL.

3. Open phpMyAdmin.

4. Import the file named `setup.sql`.

This creates the `quiz_app` database. It also creates the `users` and `quiz_attempts` tables.

5. Check the database login file:

```text
includes/db.php
```

Default AMPPS settings:

```php
$host = "localhost";
$dbname = "quiz_app";
$user = "root";
$pass = "mysql";
```

If you use XAMPP, the password may need to be changed to:

```php
$pass = "";
```

6. Open the project in your browser:

```text
http://localhost/quiz-app/
```

## URL of Deployed Website

Add your deployed website URL here after uploading it:

```text
https://your-quiz-app-url-here
```

## Database Schema

### users

| Field | Type | Description |
|---|---|---|
| id | INT AUTO_INCREMENT PRIMARY KEY | User ID |
| name | VARCHAR(100) | User name |
| email | VARCHAR(150) UNIQUE | User email |
| password_hash | VARCHAR(255) | Hashed password |
| created_at | TIMESTAMP | Account creation date |

### quiz_attempts

| Field | Type | Description |
|---|---|---|
| id | INT AUTO_INCREMENT PRIMARY KEY | Attempt ID |
| user_id | INT | Connects score to the user |
| score | INT | Number of correct answers |
| total_questions | INT | Number of questions in the quiz |
| percentage | DECIMAL(5,2) | Score percentage |
| taken_at | TIMESTAMP | Date and time quiz was taken |

## Notes

The server chooses random questions each time by shuffling the JSON question list. This means a user should usually get a different set of questions when replaying.
