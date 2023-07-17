<?php
require_once 'Sitemap.php';

$pdo = new PDO("mysql:host=localhost;dbname=sitemap", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$statement = $pdo->prepare("SELECT loc, lastmod, priority, changefreq from sitemap_test");
$statement->execute();

$arr = $statement->fetchAll(PDO::FETCH_ASSOC);

try {
    $item = new Sitemap($arr, 'csv', '/sitemap.csv');
    $item->execute();
} catch (SitemapException $e) {
    echo $e->getMessage();
}
?>