<?php

use App\Infrastructure\Http\AuthController;
use App\Infrastructure\Http\TaskController;
use App\Infrastructure\Http\UserController;
use Illuminate\Support\Str;

$requestUri = explode("/", $_SERVER['REQUEST_URI']);
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri[1] == "") {
    echo Str::slug('Hola Mundo');
}
if ($requestUri[1] === "users" && isset($requestUri[2])) {
    $controller = new UserController();
    $controller->getUserById((int)$requestUri[2]);
}

// /auth
if ($requestUri[1] === "auth" && $requestUri[2] === "login") {
    $controller = new AuthController();
    if ($requestMethod === "POST") {
        $controller->login();
    } else {
        http_response_code(405); // Método no permitido
        echo json_encode(["error" => "Method Not Allowed"]);
    }
}

/** Endpoints para Tasks
 **/

// /tasks
if ($requestUri[1] === "tasks" && !isset($requestUri[2])) {
    $controller = new TaskController();
    if ($requestMethod === "GET") {
        $controller->getAllTask();
    } elseif ($requestMethod === "POST") {
        $controller->createTask();
    } else {
        http_response_code(405); // Método no permitido
        echo json_encode(["error" => "Method Not Allowed"]);
    }
}
// /tasks/:id
if ($requestUri[1] === "tasks" && isset($requestUri[2]) && $requestUri[2] !== "update" && $requestUri[2] !== "delete") {
    $controller = new TaskController();
    if ($requestMethod === "GET") {
        $controller->getTaskById((int)$requestUri[2]);
    } else {
        http_response_code(405); // Método no permitido
        echo json_encode(["error" => "Method Not Allowed"]);
    }
}
// /tasks/update/:id
if ($requestUri[1] === "tasks" && $requestUri[2] === "update" && isset($requestUri[3])) {
    $controller = new TaskController();
    if ($requestMethod === "POST") {
        $controller->updateTask((int)$requestUri[3]);
    } else {
        http_response_code(405); // Método no permitido
        echo json_encode(["error" => "Method Not Allowed"]);
    }
}
// /tasks/delete/:id
if ($requestUri[1] === "tasks" && $requestUri[2] === "delete" && isset($requestUri[3])) {
    $controller = new TaskController();
    if ($requestMethod === "DELETE") {
        $controller->deleteTask((int)$requestUri[3]);
    } else {
        http_response_code(405); // Método no permitido
        echo json_encode(["error" => "Method Not Allowed"]);
    }
}

