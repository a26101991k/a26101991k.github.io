<!DOCTYPE html>
<html>
    <head>
        <title>Настройка базы данных</title>
    </head>
    <body>

        <h3>Setting up...</h3>

        <?php
        require_once 'functions.php';

        createTable('members','user VARCHAR(16),pass VARCHAR(16),INDEX(user(6))');

        createTable('friends','user VARCHAR(16),friend VARCHAR(16),INDEX(user(6)),INDEX(friend(6))');

        createTable('profiles','user VARCHAR(16),text VARCHAR(4096),INDEX(user(6))');
        ?>

        <br>...done.
    </body>
</html>