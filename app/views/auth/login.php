<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Product System</title>
    <style>
        * {
            box-sizing: border-box;
        }
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* Nature forest green blurry background inspired by your photo */
            background: linear-gradient(135deg, #2d4a3e 0%, #172821 100%),
                        url('https://images.unsplash.com/photo-1511497584788-876761102346?q=80&w=1920&auto=format&fit=crop') no-repeat center center fixed;
            background-blend-mode: overlay;
            background-size: cover;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            position: relative;
            width: 380px;
            margin-top: 40px;
        }
        /* Floating Avatar Circle */
        .avatar-badge {
            position: absolute;
            top: -45px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 80px;
            background-color: #1b2e25;
            border: 3px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
            z-index: 10;
        }
        .avatar-badge svg {
            width: 40px;
            height: 40px;
            fill: #ffffff;
        }
        /* Glassmorphism Card Box */
        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 60px 30px 35px 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
        }
        /* Glossy light sheen effect */
        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -50%;
            width: 200%;
            height: 50%;
            background: linear-gradient(to bottom, rgba(255,255,255,0.15), rgba(255,255,255,0));
            transform: rotate(-15deg);
            pointer-events: none;
        }
        .input-group {
            display: flex;
            align-items: center;
            background: rgba(255, 255, 255, 0.85);
            border-radius: 6px;
            margin-bottom: 20px;
            overflow: hidden;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.05);
        }
        .input-icon {
            padding: 12px 15px;
            background: #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .input-icon svg {
            width: 18px;
            height: 18px;
            fill: #555;
        }
        .input-group input {
            width: 100%;
            padding: 12px;
            border: none;
            outline: none;
            background: transparent;
            font-size: 14px;
            color: #333;
        }
        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            color: #e0e0e0;
            margin-bottom: 25px;
        }
        .form-options label {
            display: flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
        }
        .form-options a {
            color: #ddd;
            text-decoration: none;
        }
        .form-options a:hover {
            text-decoration: underline;
        }
        .btn-login {
            width: 100%;
            background-color: #1b2e25;
            color: #ffffff;
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding: 12px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            letter-spacing: 1px;
            cursor: pointer;
            transition: background 0.3s ease;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        .btn-login:hover {
            background-color: #243d31;
        }
        .error-msg {
            background: rgba(255, 0, 0, 0.2);
            border: 1px solid rgba(255, 0, 0, 0.4);
            color: #ffcccc;
            padding: 10px;
            border-radius: 6px;
            font-size: 13px;
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>

    <div class="login-container">
        <!-- Floating User Avatar -->
        <div class="avatar-badge">
            <svg viewBox="0 0 24 24">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
        </div>

        <!-- Glassmorphism Box -->
        <div class="glass-card">
            
            <?php if (isset($_SESSION['error'])): ?>
                <div class="error-msg">
                    <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                </div>
            <?php endif; ?>

            <form action="<?= site_url('auth/login'); ?>" method="POST">
                
                <!-- Username / Email Field -->
                <div class="input-group">
                    <div class="input-icon">
                        <svg viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                    </div>
                    <input type="text" name="username" placeholder="Username" required>
                </div>

                <!-- Password Field -->
                <div class="input-group">
                    <div class="input-icon">
                        <svg viewBox="0 0 24 24"><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>
                    </div>
                    <input type="password" name="password" placeholder="Password" required>
                </div>

                <div class="form-options">
                    <label>
                        <input type="checkbox" name="remember"> Remember me
                    </label>
                    <a href="#">Forgot Password?</a>
                </div>

                <button type="submit" class="btn-login">LOGIN</button>
            </form>
        </div>
    </div>

</body>
</html>