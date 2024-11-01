<?php

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Services\UserService;

class UserController {
    private $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function index(Request $request, Response $response): Response {
        $users = $this->userService->getAllUsers();
        return $response->withJson($users);
    }

    public function show(Request $request, Response $response, array $args): Response {
        $user = $this->userService->getUserById($args['id']);
        return $user ? $response->withJson($user) : $response->withStatus(404);
    }

    public function create(Request $request, Response $response): Response {
        $data = $request->getParsedBody();
        $newUser = $this->userService->createUser($data['name'], $data['email']);
        return $response->withJson($newUser, 201);
    }

    public function update(Request $request, Response $response, array $args): Response {
        $data = $request->getParsedBody();
        $this->userService->updateUser($args['id'], $data['name'], $data['email']);
        return $response->withStatus(204);
    }
}