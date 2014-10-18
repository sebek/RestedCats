<?php

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
     * Seed initial data
     */
    $cats = [
        [
            "name" => "Grumpy",
            "color" => "White",
            "age" => 4
        ],
        [
            "name" => "Grolle",
            "color" => "Gray",
            "age" => 10
        ]
    ];

    $insert = "INSERT INTO cats (name, color, age) VALUES (:name, :color, :age)";
    $stmt = $db->prepare($insert);

    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":color", $color);
    $stmt->bindParam(":age", $age);

    foreach ($cats as $cat) {
        $name = $cat["name"];
        $color = $cat["color"];
        $age = $cat["age"];

        $stmt->execute();
    }

    echo "Cats created and petted.";

} catch (PDOException $e) {
    echo $e->getMessage();
}
