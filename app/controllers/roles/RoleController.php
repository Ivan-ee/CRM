<?php

require_once 'app/models/roles/Role.php';

class RoleController{
    public function index() {
        $userModel = new User();
        $users = $userModel->readAll();

        include 'app/views/users/index.php';
    }

    public function create() {
        include 'app/views/users/create.php';
    }

    public function store() {
        if (isset($_POST['role_name']) && isset($_POST['role_description'])){
            $role_name = $_POST['role_name'];
            $role_description = $_POST['role_description'];

            if (empty($role_name)){
                echo "Название роли не заполнено.";
                return;
            }

            $roleModel = new Role();
            $roleModel->createRole($role_name, $role_description);
        }
        header("Location: index.php?page=roles");
    }

    public function edit($id) {
        $roleModel = new Role();
        $role = $roleModel->getRoleById($id);

        if (!$role){
            echo "Роль не найдена.";
            return;
        }

        include 'app/views/roles/edit.php';
    }

    public function update() {
        if (isset($_POST['id']) && isset($_POST['role_name']) && isset($_POST['role_description'])) {
            $id = $_POST['id'];
            $role_name = $_POST['role_name'];
            $role_description = $_POST['role_description'];


            $roleModel = new Role();
            $roleModel->updateRole($id, $role_name, $role_description);
        }

        header("Location: index.php?page=roles");
    }

    public function delete() {
        $roleModel = new Role();
        $roleModel->deleteRoel($_GET['id']);

        header("Location: index.php?page=roles");
    }
}

