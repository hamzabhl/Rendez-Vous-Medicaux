<!DOCTYPE html>
<html>
    <head>
        <title>Test Password Reset</title>
    </head>
    <body>
        <h2>Send Reset Code</h2>
        <form action="controller/passwordController.php" method="post">
            <input type="hidden" name="action" value="send_code" />
            Email: <input type="email" name="email" required />
            <button type="submit">Send Code</button>
        </form>

        <h2>Verify Code</h2>
        <form action="controller/passwordController.php" method="post">
            <input type="hidden" name="action" value="verify_code" />
            Code: <input type="text" name="code" required />
            <button type="submit">Verify</button>
        </form>

        <h2>Reset Password</h2>
        <form action="controller/passwordController.php" method="post">
            <input type="hidden" name="action" value="reset_password" />
            New Password: <input type="password" name="new_password" required />
            <button type="submit">Reset</button>
        </form>
    </body>
</html>
