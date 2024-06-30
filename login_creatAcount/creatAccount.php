<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const message = urlParams.get('message');
            if (message) {
                alert(decodeURIComponent(message));
            }
        });
    </script> -->
    <style>
        .custom-file-upload {
            display: inline-block;
            cursor: pointer;
        }
        
        .custom-file-upload input[type="file"] {
            display: none;
        }

        .custom-file-upload span {
            border: 2px solid #ddd;
            border-radius: 50%;
            padding: 10px;
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="background">
        <div class="container">
            <div class="logo-container">
                <img src="../Images/WhatsApp-logo/01_Glyph/01_Digital/03_PNG/Green/Digital_Glyph_Green.png" alt="WhatsApp Logo" class="logo">
            </div>
            <div class="form-container" id="signup-form">
                <h1>Sign Up</h1>
                <form action="account.php" method="POST" enctype="multipart/form-data">
                    <label for="photo" class="custom-file-upload">
                        <input type="file" id="photo" name="photo" accept="image/*" required>
                        <span>Upload Photo</span>
                    </label><br><br>
                    <input type="text" id="phone" name="phone" placeholder="Phone Number" required>
                    <input type="text" id="name" name="name" placeholder="Name" required>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                    <button type="submit" id="signup-button">Sign Up</button>
                </form>
                <p>Already have an account? <a href="../login_creatAcount/index.php">Login</a></p>
            </div>
        </div>
    </div>
</body>
</html>
