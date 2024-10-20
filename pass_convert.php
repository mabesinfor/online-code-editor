<?php
$hashed_passwords = '';
$plain_passwords = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['convert'])) {
        $plain_passwords = $_POST['plain_passwords'];
        $plain_passwords_array = explode("\n", $plain_passwords);
        $hashed_passwords_array = array_map(function($password) {
            return password_hash(trim($password), PASSWORD_BCRYPT);
        }, $plain_passwords_array);
        $hashed_passwords = implode("\n", $hashed_passwords_array);
    } elseif (isset($_POST['reset'])) {
        $hashed_passwords = '';
        $plain_passwords = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Hash Converter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        textarea {
            width: 100%;
            height: 150px;
            margin-bottom: 10px;
        }
        input[type="submit"], button {
            background-color: #4CAF50;
            border: none;
            color: white;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        button[type="reset"] {
            background-color: #f44336;
        }
    </style>
</head>
<body>
    <h1>Password Hash Converter</h1>
    <form method="post">
        <textarea name="plain_passwords" placeholder="Masukkan password plain, satu per baris"><?php echo htmlspecialchars($plain_passwords); ?></textarea>
        <br>
        <input type="submit" name="convert" value="Convert">
        <button type="submit" name="reset">Reset</button>
    </form>

    <?php if (!empty($hashed_passwords)): ?>
        <h2>Hasil Hash:</h2>
        <textarea readonly><?php echo htmlspecialchars($hashed_passwords); ?></textarea>
    <?php endif; ?>
</body>
</html>