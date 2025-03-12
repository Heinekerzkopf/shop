<?php http_response_code(500); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Development Error</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            padding: 50px;
        }
        .container {
            max-width: 800px;
            background: white;
            padding: 20px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: left;
        }
        h1 {
            font-size: 36px;
            color: #d9534f;
        }
        p {
            font-size: 18px;
            color: #666;
        }
        pre {
            background: #eee;
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Development Error</h1>
        <p>An error has occurred during the execution of this script.</p>
        <p><strong>Error Code:</strong> <?php /** @var $errno \wfm\ErrorHandler */ echo $errno; ?></p>
        <p><strong>Message:</strong> <?php /** @var $errstr \wfm\ErrorHandler */ echo $errstr; ?></p>
        <p><strong>File:</strong> <?php /** @var $errfile \wfm\ErrorHandler */ echo $errfile; ?></p>
        <p><strong>Line:</strong> <?php /** @var $errline \wfm\ErrorHandler */ echo $errline; ?></p>
        <pre><?php debug_print_backtrace(); ?></pre>
    </div>
</body>
</html>