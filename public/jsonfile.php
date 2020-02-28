<?php

require ‘DB.php’;
DB::connect(‘localhost’, ‘laravel_hackathon’, ‘root’, ‘rootroot’);
$data = json_decode(file_get_contents(‘jsondata.json’), true);
foreach($data as $owner)
{
  // $sql = “INSERT INTO owners(first_name, surname, telephone, home_address) VALUES(‘“.$row[“first_name”].“‘, ‘“.$row[“surname”].“‘, ‘“.$row[“telephone”].“’ ‘“.$row[“home_address”].“’)“;
  $sql = "INSERT INTO owners(first_name, surname, pet_name, home_address, telephone_number) VALUES(?, ?, ?, ?, ?)";
  DB::insert($sql, [
    $owner['first_name'],
    $owner['surname'],
    $owner['pet_name'],
    $owner['home_address'],
    $owner['telephone_number']
  ]);
  $owner_id = DB::lastInsertId();
  foreach($owner['pets'] as $pet)
  {
    $sql = "INSERT INTO pets(name, owner_id, breed, weight, age, image) VALUES(?, ?, ?, ?, ?, ?)";
    DB::insert($sql, [
      $pet["name"],
      $pet["owner_id"],
      $pet["breed"],
      $pet["weight"],
      $pet["age"],
      $pet["image"]
    ]);
  };
};
