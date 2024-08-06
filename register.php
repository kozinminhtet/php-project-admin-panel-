<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <div class="container w-100">
        <h1 class="h3 mb-3 mt-4">Register</h1>
        
        <form action="_actions/create.php" method="post" class="fo">
            <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
            <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
            <input type="text" name="phone" class="form-control mb-2" placeholder="Phone" required>
            <textarea name="address" id="" placeholder="Address" class="form-control" required></textarea>
            <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
            <button class="btn btn-primary " type="submit">Register</button>
        
            <a href="index.php">Login</a>
        </form><br>
    </div>
    
</body>
</html>



