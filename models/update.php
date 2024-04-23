<?php

include "connection.php";

$obj = new Connection();
$conn = $obj->connect();

$dni = $_GET['dni'];
$name = $_POST['name'];
$last_name = $_POST['last_name'];
$address = $_POST['address'];
$phone = $_POST['phone'];

$query = "UPDATE students SET name = '$name', last_name = '$last_name', address = '$address', phone = '$phone' WHERE dni = '$dni';";

$resultado = $conn->query($query);

$response = array();

if ($resultado) {
    $response['status'] = 'success';
    $response['message'] = 'Estudiante actualizado correctamente';
} else {
    $response['status'] = 'error';
    $response['message'] = 'Error al actualizar el estudiante';
}

echo json_encode($response);
