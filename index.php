<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container text-center" style="max-width: 600px">
        <h1 class="h3 mb-3 mt-4">Login</h1>

        <?php if(isset($_GET['incorrect'])): ?>
            <div class="alert alert-warning">
                incorrect email or password
            </div>
        <?php endif ?>

        <?php if(isset($_GET['register'])) : ?>
            <div class="alert alert-info">
                Account created
            </div>
        <?php endif ?>
        
        <?php if(isset($_GET['suspend'])) : ?>
            <div class="alert alert-danger">
                Account suspended !
            </div>
        <?php endif ?>

        <form action="_actions/login.php" method="post">
            <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
            <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
            <button class="btn btn-primary w-100">Login</button>

            <a href="register.php">Register</a>
        </form>
    </div>
</body>
</html>