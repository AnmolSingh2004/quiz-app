<?php
# anmol singh
# results page that shows the user's quiz score

# include database connection
require_once 'includes/db.php';

# include auth functions
require_once 'includes/auth.php';

# user must be logged in to see results
require_login();

# get attempt id from URL
$id = (int)($_GET['id'] ?? 0);

# get the quiz attempt for the logged in user
$stmt = $pdo->prepare('SELECT * FROM quiz_attempts WHERE id = ? AND user_id = ?');
$stmt->execute([$id, $_SESSION['user_id']]);
$attempt = $stmt->fetch(PDO::FETCH_ASSOC);

# include header
include 'includes/header.php';
?>

<!-- results section -->
<section class="card results-card">

    <?php if ($attempt): ?>

        <!-- results title -->
        <h2>Your Results</h2>

        <!-- big score display -->
        <div class="score-big">
            <?php echo htmlspecialchars($attempt['score']); ?>/<?php echo htmlspecialchars($attempt['total_questions']); ?>
        </div>

        <!-- percentage display -->
        <p>You scored <?php echo htmlspecialchars(number_format($attempt['percentage'], 2)); ?>%.</p>

        <!-- result action buttons -->
        <div class="actions">
            <a class="btn" href="index.php">Play Again</a>
            <a class="btn secondary" href="profile.php">View Profile</a>
            <a class="btn secondary" href="leaderboard.php">Leaderboard</a>
        </div>

    <?php else: ?>

        <!-- message if result id is not valid -->
        <h2>Result not found</h2>
        <a class="btn" href="index.php">Go Home</a>

    <?php endif; ?>

</section>

<?php include 'includes/footer.php'; ?>
