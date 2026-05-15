<?php
# anmol singh
# submit quiz page that grades answers and saves the score

# include database connection
require_once 'includes/db.php';

# include auth functions
require_once 'includes/auth.php';

# user must be logged in to submit quiz
require_login();

# get questions saved in session
$questions = $_SESSION['quiz_questions'] ?? [];

# get answers submitted from the form
$answers = $_POST['answers'] ?? [];

# if questions are missing, send user back home
if (!$questions) {
    header('Location: index.php');
    exit;
}

# start score at 0
$score = 0;

# loop through questions and compare user answer to correct answer
foreach ($questions as $index => $q) {

    # add 1 point if the answer is correct
    if (($answers[$index] ?? '') === $q['answer']) {
        $score++;
    }
}

# count total questions
$total = count($questions);

# calculate percentage score
$percentage = ($score / $total) * 100;

# save quiz attempt in database
$stmt = $pdo->prepare(
    'INSERT INTO quiz_attempts (user_id, score, total_questions, percentage)
     VALUES (?, ?, ?, ?)'
);

# insert current user's score
$stmt->execute([
    $_SESSION['user_id'],
    $score,
    $total,
    $percentage
]);

# get the new attempt id
$attemptId = $pdo->lastInsertId();

# remove quiz questions from session after grading
unset($_SESSION['quiz_questions']);

# redirect to results page
header('Location: results.php?id=' . $attemptId);
exit;
?>
