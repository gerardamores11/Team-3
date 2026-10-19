<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Sun Son Solar</title>
    <link rel="stylesheet" href="/css/design.css">
</head>
<body class="login-page auth-page">
<main class="auth-layout">
    <section class="auth-intro">
        <a class="brand" href="/">SUN SON SOLAR</a>
        <p class="eyebrow">Secure account access</p>
        <h1>Welcome back</h1>
        <p>Customers can manage services and account information. Employees can securely access assigned tools using accounts created by HR or an administrator.</p>
        <a class="back-link" href="/">← Return to Homepage</a>
    </section>
    <section class="auth-card">
        <h2>Sign In</h2>
        <?php if (! empty($message)): ?><div class="alert success"><?= esc($message) ?></div><?php endif; ?>
        <?php if (! empty($error)): ?><div class="alert error"><?= esc($error) ?></div><?php endif; ?>
        <form action="/login" method="post">
            <?= csrf_field() ?>
            <label for="identifier">Email or Username</label>
            <input type="text" id="identifier" name="identifier" value="<?= old('identifier') ?>" autocomplete="username" required>
            <label for="password">Password</label>
            <div class="password-wrap"><input type="password" id="password" name="password" autocomplete="current-password" required><button class="toggle-password" type="button" data-target="password">Show</button></div>
            <button class="button primary full" type="submit">Sign In</button>
        </form>
        <div class="auth-note"><p>New customer? <a href="/register">Create an Account</a></p><p>Employee accounts are created by HR or administrators.</p></div>
    </section>
</main>
<script src="/js/main.js"></script>
</body>
</html>
