<?php 
session_start();
require_once 'includes/db.php';
require_once 'classes/User.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = (new Database())->getConnection();
    $userObj = new User($db);
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user = $userObj->login($email, $password);
    if ($user) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];
        header("Location: users.php");
        exit;
    } else {
        $error = "Incorrect Password or User Doesn't Exist!";
    }
}
?>

<?php include 'includes/header.php'; ?>

<main>
    <div class="background-image"></div>
    <div class="login-container">
        <h1>Login Here</h1>
        <?php if ($error): ?>
            <p class="error-msg"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="login.php" method="POST">
            <input type="email" name="email" placeholder="Enter Email Here" required>
            <input type="password" name="password" placeholder="Enter Password Here" required>
            <button type="submit">Login</button>
        </form>
        <p class="signup">Don't have an account? <a href="signup.php">Sign up here</a></p>
        <div class="social-login">
            <p>Or login with:</p>
            <div class="icon-container">
                <a href="#"><ion-icon name="logo-facebook"></ion-icon></a>
                <a href="#"><ion-icon name="logo-instagram"></ion-icon></a>
                <a href="#"><ion-icon name="logo-twitter"></ion-icon></a>
                <a href="#"><ion-icon name="logo-google"></ion-icon></a>
                <a href="#"><ion-icon name="logo-skype"></ion-icon></a>
            </div>
        </div>
    </div>
</main>

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }
    body {
        font-family: Arial, sans-serif;
        color: #fff;
        overflow: hidden;
    }
    .background-image {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('images/board.jpg') no-repeat center center/cover;
        filter: brightness(0.5);
        z-index: -1;
    }
    .login-container {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background: rgba(0, 0, 0, 0.8);
        padding: 30px;
        border-radius: 15px;
        box-shadow: 0 0 15px rgba(255, 165, 0, 0.5);
        width: 350px;
    }
    h1 {
        text-align: center;
        margin-bottom: 20px;
        color: orange;
    }
    .error-msg {
        color: red;
        text-align: center;
        margin-bottom: 10px;
    }
    form input {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: none;
        border-radius: 8px;
    }
    form button {
        width: 100%;
        padding: 10px;
        background-color: orange;
        color: white;
        border: none;
        cursor: pointer;
        border-radius: 8px;
        font-size: 18px;
    }
    form button:hover {
        background-color: darkorange;
    }
    .signup {
        text-align: center;
        margin-top: 15px;
    }
    .signup a {
        color: orange;
        text-decoration: none;
    }
    .signup a:hover {
        text-decoration: underline;
    }
    .social-login {
        text-align: center;
        margin-top: 15px;
    }
    .icon-container {
        display: flex;
        justify-content: center;
        gap: 15px;
        margin-top: 10px;
    }
    .icon-container a {
        color: white;
        font-size: 40px;
        transition: color 0.3s ease;
    }
    .icon-container a:hover {
        color: orange;
    }
</style>

<script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js" type="module"></script>
<script src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js" nomodule></script>
