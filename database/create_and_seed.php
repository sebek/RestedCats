<?php

$baseDir = dirname(__FILE__);

try {

    $db = new PDO("sqlite:restedcats.sqlite3");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /**
     * Create cats table
     */
    $db->exec(
        "
          CREATE TABLE IF NOT EXISTS cats (
            id INTEGER PRIMARY KEY,
            name TEXT,
            color TEXT,
            age INTEGER
          )
         "
    );

    /**
     * Empty cats table before seed
     */
    $db->exec(
        "
            DELETE FROM cats
        "
    );

    /**
     * Seed initial data
     */
    $cats = file_get_contents("{$baseDir}/cats.json");
    $cats = json_decode($cats);

    $insert = "INSERT INTO cats (name, color, age) VALUES (:name, :color, :age)";
    $stmt = $db->prepare($insert);

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":color", $color);
    $stmt->bindParam(":age", $age);

    foreach ($cats as $cat) {
        $name = $cat->name;
        $color = $cat->color;
        $age = $cat->age;
        $stmt->execute();
    }

    echo "Cats created and petted.";

} catch (PDOException $e) {
    echo $e->getMessage();
}
