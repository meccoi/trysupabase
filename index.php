<?php
// Get the page parameter from the URL
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$id = isset($_GET['id']) ? $_GET['id'] : null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        echo ($page == 'home')
            ? 'Home'
            : (($page == 'login')
                ? 'Login'
                : (($page == 'signup')
                    ? 'Signup'
                    : str_replace('admin/', '', $page)
                )
            );
        ?>
    </title>

    <?php include 'header.php'; ?>
    <style>
        @font-face {
            font-family: 'ProductSans';
            src: url('assets/fonts/productSans-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'GoogleSans';
            src: url('assets/fonts/GoogleSans-Regular.ttf') format('truetype');
            font-weight: normal;
            font-style: normal;
        }

        * {
            margin: unset;
            padding: unset;
            box-sizing: border-box;
        }

        body {

            font-size: 1.125rem;
            line-height: 1.6;
        }

        /* 
        main {
            width: min(165ch, 100% - 4rem);
            margin-inline: auto;
        } */

        img {
            max-width: 100%;
            display: block;
        }
    </style>
</head>

<body>

    <?php


    // Define a whitelist of allowed pages
    $allowed_pages = ['home', 'login', 'signup', 'admin/dashboard', 'admin/site_setting', 'admin/logout'];

    // Start output buffering to capture HTML output
    ob_start();

    // Buffer the menu HTML if it's not an admin page
    if (strpos($page, 'admin') === false) {
    ?>
        <div class="ui secondary pointing menu">
            <a class="item" href="home">
                <img src="https://semantic-ui.com/images/logo.png" alt="Logo" style="height: 24px;">
            </a>
            <a class="item" href="home">Home</a>
            <a class="item" href="about">About</a>
            <a class="item" href="services">Services</a>
            <a class="item" href="contact">Contact</a>

            <div class="right menu">
                <div class="ui simple dropdown item">
                    More
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <a class="item" href="profile">Profile</a>
                        <a class="item" href="settings">Settings</a>
                        <a class="item" href="logout">Logout</a>
                    </div>
                </div>
                <a class="item" href="login">Login</a>
                <a class="item" href="signup">Signup</a>
            </div>
        </div>

        <main class="md:mx-4">
        <?php
    }



    // Include the corresponding PHP file if it exists in the whitelist
    if (in_array($page, $allowed_pages)) {
        // Construct the path to include
        $file_path = str_replace('/', DIRECTORY_SEPARATOR, $page) . '.php';
        if (file_exists($file_path)) {
            include $file_path;
        } else {
            include '404.php'; // Include a 404 page for unknown pages
        }
    } else {
        include '404.php'; // Include a 404 page for unknown pages
    }

    // Get the captured output and echo it
    echo ob_get_clean();
        ?>
        </main>


</body>

</html>