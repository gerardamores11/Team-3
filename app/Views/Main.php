<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | Sun Son Solar</title>
    <link rel="stylesheet" href="/css/design.css">
</head>
<body class="register-page auth-page">
<main class="auth-layout register-layout">
    <section class="auth-intro">
        <a class="brand" href="/">SUN SON SOLAR</a>
        <p class="eyebrow">Customer registration</p>
        <h1>Create your account</h1>
        <p>Only customers may register here. Employee accounts are created securely by HR or administrators.</p>
        <a class="back-link" href="/login">← Return to Login</a>
    </section>
    <section class="auth-card wide">
        <h2>Register</h2>
        <?php if (! empty($errors)): ?><div class="alert error"><ul><?php foreach ($errors as $item): ?><li><?= esc($item) ?></li><?php endforeach; ?></ul></div><?php endif; ?>
        <form action="/register" method="post" id="register-form">
            <?= csrf_field() ?>
            <div class="form-grid">
                <div><label for="Fname">First Name</label><input type="text" id="Fname" name="Fname" value="<?= old('Fname') ?>" required></div>
                <div><label for="Mname">Middle Name</label><input type="text" id="Mname" name="Mname" value="<?= old('Mname') ?>"></div>
                <div><label for="Lname">Last Name</label><input type="text" id="Lname" name="Lname" value="<?= old('Lname') ?>" required></div>
                <div><label for="Bday">Birthdate</label><input type="date" id="Bday" name="Bday" value="<?= old('Bday') ?>" required></div>
                <div><label for="Gender">Gender</label><select id="Gender" name="Gender" required><option value="">Select</option><option>Male</option><option>Female</option><option>Prefer not to say</option></select></div>
                <div><label for="PhNo">Phone Number</label><input type="tel" id="PhNo" name="PhNo" value="<?= old('PhNo') ?>" maxlength="11" pattern="[0-9]{11}" required></div>
                <div class="span-two"><label for="EmAdd">Email Address</label><input type="email" id="EmAdd" name="EmAdd" value="<?= old('EmAdd') ?>" required></div>
                <div class="span-two"><label for="Addrs">Address</label><input type="text" id="Addrs" name="Addrs" value="<?= old('Addrs') ?>" required></div>
                <div class="span-two"><label for="Uname">Username</label><input type="text" id="Uname" name="Uname" value="<?= old('Uname') ?>" minlength="4" required></div>
                <div><label for="Pwd">Password</label><div class="password-wrap"><input type="password" id="Pwd" name="Pwd" minlength="8" required><button class="toggle-password" type="button" data-target="Pwd">Show</button></div></div>
                <div><label for="CPwd">Confirm Password</label><input type="password" id="CPwd" name="CPwd" minlength="8" required></div>
            </div>
            <label class="check-row"><input type="checkbox" id="TnC" name="TnC" value="1" required><span>I agree to the Terms & Conditions.</span></label>
            <button class="button primary full" type="submit">Create Customer Account</button>
        </form>
        <p class="auth-note">Already have an account? <a href="/login">Sign In</a></p>
    </section>
</main>
<script src="/js/main.js"></script>
</body>
</html>
