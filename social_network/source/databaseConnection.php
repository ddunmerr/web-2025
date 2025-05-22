<?php

function connectDatabase(): PDO
{
    $dsn = 'mysql:host=127.0.0.1;dbname=blog';
    $user = 'root';
    return new PDO($dsn, $user);
}



function findPostInDatabase(PDO $connection, int $id): ?array
{
    $query = <<<SQL
        SELECT 
            id, id_user, descr, likes, publish_date 
        FROM post 
        WHERE id = $id
    SQL;
    $statement = $connection->query($query);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    return $row ?: null;
}
function getAllPosts(PDO $connection): array
{
    $query = <<<SQL
        SELECT 
            p.id, p.id_user, p.descr, p.likes, p.publish_date, c.image_1
        FROM post AS p
        JOIN carousel AS c ON p.id_carousel = c.id
    SQL;
    $statement = $connection->query($query);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}



function findUserInDatabase(PDO $connection, int $id): ?array
{
    $query = <<<SQL
        SELECT 
            id, first_name, second_name, avatar 
        FROM user 
        WHERE id = $id
    SQL;
    $statement = $connection->query($query);
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    return $row ?: null;
}

$postId = (int)$_GET['post_id'];
if (!$postId) {
    return 0;
}
require __DIR__ . '/../templates/post.php';
