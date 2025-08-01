<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Default Title'; ?></title>
    <meta name="description" content="<?php echo isset($pageDesc) ? $pageDesc : 'Default description'; ?>">
    <meta name="robots" content="noindex,nofollow">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans:ital,wght@0,400;0,600;1,400&family=Montserrat+Alternates:wght@400;500&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
<header class="logged_header">
    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="dashboard.php">
                <?php if (!empty($_SESSION['userprofile'])): ?>
                    <img class="profile" src="./uploads/<?= htmlspecialchars($_SESSION['userprofile']) ?>" alt="Profile Picture" width="50" height="50">
                <?php else: ?>
                    <img src="./img/logo.jpg" alt="Default Logo" width="50">
                <?php endif; ?>
                <?php if (!empty($_SESSION['username'])): ?> <?= htmlspecialchars($_SESSION['username']) ?>
                <?php else: ?>
                User
                <?php endif; ?>
            </a>
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link btn active" aria-current="page" href="review.php">Creat New Review</a>
                </li>
                <li class="nav-item">
                    <a href="logout.php" class="btn btn-danger mb-3">Logout</a>
                </li>
            </ul>
        </div>
    </nav>
</header>