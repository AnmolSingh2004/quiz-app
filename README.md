# Project 2: Quiz App  
### Anmol Singh

This is a PHP and MySQL quiz application created for Project 2.

---

# Features Developed

- Home page where users can start the quiz
- User signup and login system
- Logout functionality
- Quiz page with random questions from `questions.json`
- Timer for the quiz
- Option to choose 10, 15, or 20 questions
- Results page showing the final score and percentage
- Saves quiz attempts into MySQL database
- Profile page showing previous quiz history
- Leaderboard page displaying top 10 scores
- Restart/replay functionality after finishing the quiz

---

# How to Run the Server

1. Put the project folder inside your local server directory.

### XAMPP
C:\xampp\htdocs\quiz-app

6. Open the project in your browser:

http://localhost/quiz-app/

---

# Deployed Website URL

For this i used Render.com 

https://quiz-app-lriz.onrender.com/index.php

---

# Database Schema

## users

| Field | Type |
|---|---|
| id | INT AUTO_INCREMENT PRIMARY KEY |
| name | VARCHAR(100) |
| email | VARCHAR(150) UNIQUE |
| password_hash | VARCHAR(255) |
| created_at | TIMESTAMP |

---

## quiz_attempts

| Field | Type |
|---|---|
| id | INT AUTO_INCREMENT PRIMARY KEY |
| user_id | INT |
| score | INT |
| total_questions | INT |
| percentage | DECIMAL(5,2) |
| taken_at | TIMESTAMP |
