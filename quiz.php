<?php
# anmol singh
# quiz page that loads random questions from the JSON file

# include auth functions
require_once 'includes/auth.php';

# user must be logged in to take quiz
require_login();

# get the question count from the URL
$count = (int)($_GET['count'] ?? 10);

# only allow these question amounts
if (!in_array($count, [10, 15, 20])) {
    $count = 10;
}

# load questions from the JSON file
$questions = json_decode(file_get_contents(__DIR__ . '/data/questions.json'), true);

# randomize questions so user does not always get same quiz
shuffle($questions);

# select only the number of questions requested
$selected = array_slice($questions, 0, $count);

# save selected questions in session so submit page can grade them
$_SESSION['quiz_questions'] = $selected;

# include header
include 'includes/header.php';
?>

<!-- quiz section -->
<section class="card">

    <h2>Quiz</h2>

    <!-- timer display -->
    <div id="timer" class="timer">Time Left:</div>

    <!-- quiz answer form -->
    <form id="quizForm" action="submit_quiz.php" method="post">

        <!-- loop through selected questions -->
        <?php foreach ($selected as $index => $q): ?>

            <div class="question-card">

                <!-- question text -->
                <h3><?php echo ($index + 1) . '. ' . htmlspecialchars($q['question']); ?></h3>

                <div class="options">

                    <!-- loop through A, B, C, D answer choices -->
                    <?php foreach (['A','B','C','D'] as $letter): ?>

                        <label class="option">

                            <!-- radio button for answer choice -->
                            <input
                                type="radio"
                                name="answers[<?php echo $index; ?>]"
                                value="<?php echo $letter; ?>"
                                required>

                            <!-- answer text -->
                            <span>
                                <strong><?php echo $letter; ?>.</strong>
                                <?php echo htmlspecialchars($q[$letter]); ?>
                            </span>

                        </label>

                    <?php endforeach; ?>

                </div>

            </div>

        <?php endforeach; ?>

        <!-- submit quiz button -->
        <button type="submit">Submit Quiz</button>

    </form>

</section>

<!-- start timer using JavaScript -->
<script>
startQuizTimer(<?php echo $count * 30; ?>, 'quizForm');
</script>

<?php include 'includes/footer.php'; ?>
