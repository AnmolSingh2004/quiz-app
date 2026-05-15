<?php
# anmol singh
# main home page for the quiz app

# include the header and navigation
include 'includes/header.php';
?>

<!-- home page hero section -->
<section class="hero">

    <!-- main heading -->
    <h1>Test Your Knowledge</h1>

    <!-- short description of the app -->
    <p>Play a random quiz, save your score, view your history, and compare your rank on the leaderboard.</p>

    <?php if (is_logged_in()): ?>

        <!-- form that lets a logged in user choose how many questions they want -->
        <form action="quiz.php" method="get" class="card quiz-start-card">

            <div class="form-row">

                <!-- question count dropdown -->
                <label for="count">How many questions?</label>

                <select name="count" id="count">
                    <option value="10">10 Questions</option>
                    <option value="15">15 Questions</option>
                    <option value="20">20 Questions</option>
                </select>

            </div>

            <!-- start quiz button -->
            <button type="submit">Start Quiz</button>

        </form>

    <?php else: ?>

        <!-- buttons shown when user is not logged in -->
        <div class="actions">
            <a class="btn" href="signup.php">Create Account</a>
            <a class="btn secondary" href="login.php">Login</a>
        </div>

    <?php endif; ?>

</section>

<?php
# include footer
include 'includes/footer.php';
?>
