<?php

include "../models/studentService.php";

$requestType = $_SERVER['REQUEST_METHOD'];
$studentService = new StudentService();

switch ($requestType) {
  case 'GET':
    $dni = $_GET['dni'];

    if (isset($dni)) {
      $student = $studentService->getOne($dni);
      echo $student;
    }
    $result = $studentService->getAll();
    echo $result;
    break;

  case 'POST':
    $dni = $_POST['dni'];
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    $result = $studentService->create(
      $dni,
      $name,
      $lastname,
      $address,
      $phone
    );
    echo $result;
    break;

  case 'PUT':
    $dni = $_GET['dni'];
    $name = $_GET['name'];
    $lastname = $_GET['lastname'];
    $address = $_GET['address'];
    $phone = $_GET['phone'];

    $result = $studentService->update(
      $dni,
      $name,
      $lastname,
      $address,
      $phone
    );
    echo $result;
    break;

  case 'DELETE':
    $dni = $_GET['dni'];
    $result = $studentService->delete($dni);
    echo $result;
    break;

  default:
    echo 'METHOD NOT IMPLEMENTED';
    break;
}