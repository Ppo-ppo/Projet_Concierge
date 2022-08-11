<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Login Conciergerie</title>
</head>
<body>
<main class="mainContainer">
    <form action="connect.php" class="login" method="post">
        <h1>Login</h1>
        <div class="username">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username">
        </div>
        <div class="password">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
        </div>  
        <section>
            <button class="btn" type="submit" name="action" value="login">Login</button>
        </section>
    </form>
    
</main>  
</body>
</html>