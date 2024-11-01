<?php

namespace App\Services;
use App\Models\User;

class UserService {
    private $dataFile = __DIR__ . '/../../database/users.json';

    private function loadData() {
        $json = file_get_contents($this->dataFile);
        return json_decode($json, true) ?? [];
    }

    private function saveData(array $data) {
        file_put_contents($this->dataFile, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function getAllUsers() {
        $data = $this->loadData();
        return array_map(fn($user) => new User($user['id'], $user['name'],$user['email']), $data);
    }

    public function getUserById($id) {
        $users = $this->loadData();
        $filteredUsers = array_filter($users, fn($user) => $user['id'] === $id);

        $user = reset($filteredUsers);
        return $user ? new User($user['id'], $user['name'], $user['email']) : null;
    }


    public function createUser($name, $email) {
        $users = $this->loadData();
        $newUser = ['id' => uniqId(), 'name' => $name, 'email' => $email];
        $users[] = $newUser;
        $this->saveData($users);
        return $newUser;
    }

    public function updateUser($id, $name, $email) {
        $users = $this->loadData();
        foreach ($users as &$user) {
            if ((int)$user['id'] === (int)$id) {
                $user['name'] = $name;
                $user['email'] = $email;
                break;
            }
        }
        file_put_contents('debug.log', print_r($users, true));
        $this->saveData($users);
    }
}