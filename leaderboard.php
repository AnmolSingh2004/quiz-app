<?php
# anmol singh
# leaderboard page that shows the top 10 players

# include database connection
require_once 'includes/db.php';

# include auth functions
require_once 'includes/auth.php';

# get top 10 users based on best percentage, best score, and games played
$stmt = $pdo->query('
    SELECT
        u.name,
        MAX(a.percentage) AS best_percentage,
        MAX(a.score) AS best_score,
        MAX(a.total_questions) AS total_questions,
        COUNT(a.id) AS games_played
    FROM users u
    JOIN quiz_attempts a ON u.id = a.user_id
    GROUP BY u.id, u.name
    ORDER BY best_percentage DESC, best_score DESC, games_played DESC
    LIMIT 10
');

# fetch leaderboard rows
$leaders = $stmt->fetchAll(PDO::FETCH_ASSOC);

# include header
include 'includes/header.php';
?>

<!-- leaderboard section -->
<section class="card">

    <h2>Top 10 Leaderboard</h2>

    <div class="table-wrap">

        <table>

            <!-- table headings -->
            <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Best Score</th>
                <th>Best %</th>
                <th>Games Played</th>
            </tr>

            <?php if ($leaders): ?>

                <!-- display each leaderboard player -->
                <?php foreach ($leaders as $i => $row): ?>

                    <tr>
                        <td><?php echo $i + 1; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['best_score']); ?>/<?php echo htmlspecialchars($row['total_questions']); ?></td>
                        <td><?php echo htmlspecialchars(number_format($row['best_percentage'], 2)); ?>%</td>
                        <td><?php echo htmlspecialchars($row['games_played']); ?></td>
                    </tr>

                <?php endforeach; ?>

            <?php else: ?>

                <!-- message if no scores are saved yet -->
                <tr>
                    <td colspan="5">No scores yet.</td>
                </tr>

            <?php endif; ?>

        </table>

    </div>

</section>

<?php include 'includes/footer.php'; ?>
