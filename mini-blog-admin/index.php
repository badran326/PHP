<?php
    session_start();
    if(!isset($_SESSION['user_id'])){
        require "./template/header.php";
    } else {
        require './template/loggedHeader.php';
        require './inc/db.php';
    }
    require './inc/blog_admin.php';
    $db = (new db())->getConnection();
    $blogAdmin = new BlogAdmin($db);
    // Fetch posts from API
    $posts = json_decode(
        file_get_contents('https://jsonplaceholder.typicode.com/posts'),
        true
    );
    // Take the first 5 posts
    $firstFive = array_slice($posts, 0, 5);
    foreach($firstFive as $post){
        if (!$blogAdmin->exist($post['id']))
            $blogAdmin->addBlogWithID($post['id'], $post['title'], $post['body'], isset($post['image']) ? $post['image'] : 'default.jpg');
    }
    ?>
<main class="index">
    <div class="container">
        <div class="login_text">
            <h4>Click me to view the Content</h4>
            <a href="posts.php" class="btn btn-outline-warning">Me</a>
        </div>
        <div class="login_text">
            <h3>Welcome to Habibi Ant Wenak Min Zaman</h3>
            <p>Login or register to review the coffees with use</p>
        </div>
    </div>
</main>
<?php
    require './template/footer.php';
    ?>