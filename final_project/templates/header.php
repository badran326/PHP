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
    <header id="header" class="header">
        <nav class="navbar navbar-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">
                    <img src="./img/logo.jpg" alt="Company logo">
                </a>
                <div class="errorMessageRow">
                    <?php if (!empty($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>
                </div>
                <form method="POST" action="login.php" class="login_form">
                    <!-- I am using the wrong input types so that we can test our php validation with no road blocks -->
                    <div class="email">
                        <label class="form-label">Email Address:
                            <input id="email" type="email" name="email" class="form-control" required>
                        </label>
                    </div>
                    <div class="password">
                        <label class="form-label">Password:
                            <input type="password" name="password" class="form-control" required>
                        </label>
                    </div>
                    <button id="login" class="btn btn-primary" type="submit">Login</button>
                    <a href="register.php" class="btn btn-secondary">Register</a>
                </form>
            </div>
        </nav>
    </header>