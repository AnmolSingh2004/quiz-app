<?php
# anmol singh
# signup page for creating a new account

# include database connection
require_once 'includes/db.php';

# include session and auth functions
require_once 'includes/auth.php';

# message variables
$error = '';
$success = '';

# run this code only when the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    # get and clean form values
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    # check for empty fields
    if ($name === '' || $email === '' || $password === '') {

        $error = 'Please fill in all fields.';

    # check for valid email format
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

        $error = 'Please enter a valid email.';

    # password must be at least 6 characters
    } elseif (strlen($password) < 6) {

        $error = 'Password must be at least 6 characters.';

    } else {

        try {

            # prepare insert statement
            $stmt = $pdo->prepare(
                'INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)'
            );

            # save user with hashed password
            $stmt->execute([
                $name,
                $email,
                password_hash($password, PASSWORD_DEFAULT)
            ]);

            # success message
            $success = 'Account created. You can now log in.';

        } catch (PDOException $e) {

            # this usually means the email already exists
            $error = 'That email is already registered.';
        }
    }
}

# include header after processing form
include 'includes/header.php';
?>

<!-- signup card -->
<section class="card form-card">

    <h2>Create Account</h2>

    <!-- show error message -->
    <?php if ($error): ?>
        <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <!-- show success message -->
    <?php if ($success): ?>
        <div class="alert success"><?php echo htmlspecialchars($success); ?></div>
    <?php endif; ?>

    <!-- signup form -->
    <form method="post">

        <div class="form-row">
            <label>Name</label>
            <input type="text" name="name" required>
        </div>

        <div class="form-row">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>

        <div class="form-row">
            <label>Password</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit">Sign Up</button>

    </form>

</section>

<?php include 'includes/footer.php'; ?>
