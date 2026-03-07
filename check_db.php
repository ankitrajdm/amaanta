<?php
try {
    $conn = new PDO('sqlite:database/amaanta.sqlite');
    $tables = $conn->query('SELECT name FROM sqlite_master WHERE type="table" ORDER BY name')->fetchAll(PDO::FETCH_COLUMN);
    echo implode("\n", $tables);
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
