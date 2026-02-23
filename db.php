<?php
function get_db()
{
    $dir = __DIR__ . '/data';
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
    $path = $dir . '/content.db';
    $pdo = new PDO('sqlite:' . $path);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
}

function get_content($section, $key)
{
    $pdo = get_db();
    $stmt = $pdo->prepare("SELECT value FROM content WHERE section = ? AND key = ?");
    $stmt->execute([$section, $key]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['value'] : '';
}

function set_content($section, $key, $value)
{
    $pdo = get_db();
    $stmt = $pdo->prepare("INSERT OR REPLACE INTO content (section, key, value) VALUES (?, ?, ?)");
    $stmt->execute([$section, $key, $value]);
}

function get_all_content()
{
    $pdo = get_db();
    $stmt = $pdo->query("SELECT section, key, value FROM content");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>