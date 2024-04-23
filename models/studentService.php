<?php

include "connection.php";

class StudentService
{

  private $conn;

  public function __construct()
  {
    $object = new Connection();
    $this->conn = $object->connect();
  }

  public function getOne($dni)
  {
    try {
      $sql = "SELECT * FROM students WHERE dni='$dni'";
      $result = $this->conn->query($sql);
      $data = $result->fetchAll(PDO::FETCH_ASSOC);
      return json_encode($data);
    } catch (Exception $e) {
      return json_encode(array($e));
    }
  }

  public function getAll()
  {
    try {
      $sql = "SELECT * FROM students;";
      $result = $this->conn->query($sql);
      $data = $result->fetchAll(PDO::FETCH_ASSOC);
      return json_encode($data);
    } catch (Exception $e) {
      return json_encode(array($e));
    }
  }

  public function create($dni, $name, $lastname, $address, $phone)
  {
    if (empty($dni) || empty($name) || empty($lastname) || empty($address) || empty($phone)) {
      return json_encode(array("error" => "Campos incompletos"));
    }

    try {
      $sql = "INSERT INTO students VALUES ('$dni', '$name', '$lastname', '$address', '$phone');";
      $result = $this->conn->query($sql);
      
      if ($result->rowCount() == 0) {
        return json_encode(array('error' => 'Error al crear el estudiante'));
      }

      return json_encode(array('success' => 'Se ha creado el estudiante'));
    } catch (Exception $e) {
      return json_encode(array($e));
    }
  }
  public function update($dni, $name, $lastname, $address, $phone)
  {
    try {

      if (empty($dni) || empty($name) || empty($lastname) || empty($address) || empty($phone)) {
        return json_encode(array("error" => "Campos incompletos"));
      }

      $sql = "UPDATE students SET name = '$name', lastname = '$lastname', address = '$address', phone = '$phone' WHERE dni = '$dni';";
      $result = $this->conn->query($sql);

      if ($result->rowCount() == 0) {
        return json_encode(array('error' => 'Error al actualizar el estudiante'));
      }

      return json_encode(array('success' => 'Se ha actualizado el estudiante'));
    } catch (Exception $e) {
      return json_encode(array($e));
    }
  }
  
  public function delete($dni)
  {
    if (empty($dni)) {
      return json_encode(array('error' => 'Cedula no ingresada'));
    }

    try {
      $sql = "DELETE FROM students WHERE dni = '$dni';";
      $result = $this->conn->query($sql);

      if ($result->rowCount() == 0) {
        return json_encode(array("error" => "No se ha podido eliminar el estudiante"));
      }

      return json_encode(array("success" => "Estudiante eliminado"));
    } catch (Exception $e) {
      return json_encode(array($e));
    }
  }
}
