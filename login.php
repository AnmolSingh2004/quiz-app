<?php
# anmol singh
# login page for existing users

# include database connection
require_once 'includes/db.php';

# include session and auth functions
require_once 'includes/auth.php';

# error message variable
$error = '';

# run this code only when login form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    # get form values
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    # find user by email
    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    # check if user exists and password is correct
    if ($user && password_verify($password, $user['password_hash'])) {

        # save user information in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];

        # redirect to home page
        header('Location: index.php');
        exit;

    } else {

        # show login error
        $error = 'Invalid email or password.';
    }
}

# include header after processing form
include 'includes/header.php';
?>

<!-- login card -->
<section class="card form-card">

    <h2>Login</h2>

    <!-- show error message -->
    <?php if ($error): ?>
        <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <!-- login form -->
    <form method="post">

        <div class="form-row">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-row">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit">Login</button>

    </form>

</section>

<?php include 'includes/footer.php'; ?>
