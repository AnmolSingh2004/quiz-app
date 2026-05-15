<?php
# anmol singh
# profile page that shows the current user's quiz history

# include database connection
require_once 'includes/db.php';

# include auth functions
require_once 'includes/auth.php';

# user must be logged in to view profile
require_login();

# get quiz attempts for the current user
$stmt = $pdo->prepare(
    'SELECT score, total_questions, percentage, taken_at
     FROM quiz_attempts
     WHERE user_id = ?
     ORDER BY taken_at DESC'
);

# run query using logged in user id
$stmt->execute([$_SESSION['user_id']]);

# fetch all quiz attempts
$attempts = $stmt->fetchAll(PDO::FETCH_ASSOC);

# include header
include 'includes/header.php';
?>

<!-- profile section -->
<section class="card">

    <!-- show user's name -->
    <h2><?php echo htmlspecialchars(current_user_name()); ?>'s Profile</h2>

    <p>Here is your quiz play history.</p>

    <div class="table-wrap">

        <table>

            <!-- table headings -->
            <tr>
                <th>Date</th>
                <th>Score</th>
                <th>Percentage</th>
            </tr>

            <?php if ($attempts): ?>

                <!-- show each quiz attempt -->
                <?php foreach ($attempts as $a): ?>

                    <tr>
                        <td><?php echo htmlspecialchars($a['taken_at']); ?></td>
                        <td><?php echo htmlspecialchars($a['score']); ?>/<?php echo htmlspecialchars($a['total_questions']); ?></td>
                        <td><?php echo htmlspecialchars(number_format($a['percentage'], 2)); ?>%</td>
                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <!-- message if user has not taken a quiz -->
                <tr>
                    <td colspan="3">No quiz attempts yet.</td>
                </tr>

            <?php endif; ?>

        </table>

    </div>

</section>

<?php include 'includes/footer.php'; ?>
