<?php http_response_code(404); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 50px;
        }
        .container {
            max-width: 600px;
            background: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }
        h1 {
            font-size: 48px;
            color: #333;
        }
        p {
            font-size: 18px;
            color: #666;
        }
        img {
            width: 100%;
            max-width: 400px;
            margin: 20px 0;
            border-radius: 10px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            text-decoration: none;
            color: white;
            background: #007BFF;
            border-radius: 5px;
            transition: background 0.3s;
        }
        a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>404</h1>
        <p>Oops! The page you're looking for doesn't exist.</p>
        <img src="<?= PATH ?>/public/errors/images/error.jpg" alt="Not Found">
        <a href="<?=PATH;?>">Go Back Home</a>
    </div>
</body>
</html>