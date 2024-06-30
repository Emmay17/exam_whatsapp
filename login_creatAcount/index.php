<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const message = urlParams.get('message');
            if (message) {
                alert(decodeURIComponent(message));
            }
        });
    </script>
</head>
<body>
    <div class="background">
        <div class="container">
            <div class="logo-container">
                <img src="../Images/WhatsApp-logo/01_Glyph/01_Digital/03_PNG/Green/Digital_Glyph_Green.png" alt="WhatsApp Logo" class="logo">
            </div>
            <div class="form-container" id="login-form">
                <h1>Login</h1>
                <form id="frm_login" action="connexion.php" method="POST">
                    <input type="text" id="login-phone" name="phone" placeholder="Phone Number" required>
                    <input type="password" id="login-password" name="password" placeholder="Password" required>
                    <button type="submit" id="login-button">Login</button>
                </form>                
                <p>Don't have an account? <a href="../login_creatAcount/creatAccount.php">Sign up</a></p>
            </div>
        </div>
    </div>
</body>
</html>
