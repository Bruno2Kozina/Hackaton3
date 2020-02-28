<?php

require_once 'DB.php';
require_once 'DB_functions.php';
DB::connect('localhost', 'clinic', 'root', 'rootroot');

DB::statement('TRUNCATE TABLE owner');
DB::statement('TRUNCATE TABLE pets');


$data = json_decode(file_get_contents('jsonfile.json'), true);
foreach($data as $owner)
{ 
  $sql = "INSERT INTO owner(first_name, surname) VALUES(?, ?)";
    DB::insert($sql, [
      $owner['first_name'],
      $owner['surname']
  ]);

  $owner_id = DB::lastInsertId();
  foreach($owner['pets'] as $pet)
  {
    $sql = "INSERT INTO pets(name, breed, weight, age, photo, owner_id) VALUES(?, ?, ?, ?, ?, ?)";
    DB::insert($sql, [
      $pet["name"],
      $pet["breed"],
      $pet["weight"],
      $pet["age"],
      $pet["photo"],
      $owner_id
    ]);
  };
};



