<?php
    include("vendor/autoload.php");

    use Libs\Database\MySQL;
    use Libs\Database\UsersTable;
    use Helpers\Auth;

    $auth = Auth::check();

    $table = new UsersTable(new MySQL);
    $users = $table->all();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <nav class="navbar navbar-dark navbar-expand bg-dark">
        <div class="container">
            <a href="#" class="navbar-light">Admin</a>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="profile.php" class="nav-link"><?=$auth->name?></a>
                </li>
                <li class="nav-item">
                    <a href="_actions/logout.php" class="nav-link">Logout</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-4">
        <table class="table table-dark table-striped table-bordered">
            <tr class="text-center">
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Action</th>
            </tr>

            <?php foreach($users as $user) : ?>
                <tr class="text-center">
                    <td><?= $user->id ?></td>
                    <td><?= $user->name ?></td>
                    <td><?= $user->email?></td>
                    <td><?= $user->phone ?></td>
                    <td>
                        <?php if($user->role_id == 3) :?>
                            <span class="badge bg-success">
                                <?= $user->role?>
                            </span>
                        <?php elseif($user->role_id == 2) :?>
                            <span class="badge bg-primary">
                                <?= $user->role?>
                            </span>
                        <?php else :?>
                            <span class="badge bg-secondary">
                                <?= $user->role?>
                            </span>
                        <?php endif ?>   
                    </td>
                    <td>
                        <div class="btn-group">
                            <!-- to remade -->
                            <?php if($auth->role_id == 3) :?>
                                <a href="#" class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">Role</a>
                                <div class="dropdown-menu">
                                    <a href="_actions/role.php?id=<?= $user->id ?>&role=1" class="dropdown-item">User</a>
                                    <a href="_actions/role.php?id=<?= $user->id ?>&role=2" class="dropdown-item">Manager</a>
                                    <a href="_actions/role.php?id=<?= $user->id ?>&role=3" class="dropdown-item">Admin</a>
                                </div>
                            <?php endif ?>

                            <?php if($auth->role_id >= 2) : ?> 
                                <?php if($user->suspended) :?>
                                    <a href="_actions/unsuspend.php?id=<?= $user->id ?>" class="btn btn-sm btn-warning">
                                        Ban
                                    </a>
                                <?php else :?>
                                    <a href="_actions/suspend.php?id=<?= $user->id ?>" class="btn btn-sm btn-outline-warning">
                                        Ban
                                    </a>
                                <?php endif ?>
                            <?php endif ?>
                            
                            <?php if($auth->role_id == 3) : ?>
                                <a href="_actions/delete.php?id=<?= $user->id ?>" class="btn btn-sm btn-danger">Delete</a>
                            <?php endif ?>
                            <?php if($auth->role_id == 1) : ?>
                                <span>-</span>
                            <?php endif ?>

                        </div>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</body>
</html>