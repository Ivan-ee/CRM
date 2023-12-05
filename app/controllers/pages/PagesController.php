<?php

require_once 'app/models/roles/RoleModal.php';

class RoleController{
    public function index() {
        $userModel = new RoleModal();
        $roles = $userModel->getAllRoles();

        include 'app/views/roles/index.php';
    }

    public function create() {
        include 'app/views/roles/create.php';
    }

    public function store() {
        if (isset($_POST['role_name']) && isset($_POST['role_description'])){
            $role_name = $_POST['role_name'];
            $role_description = $_POST['role_description'];

            if (empty($role_name)){
                echo "Название роли не заполнено.";
                return;
            }

            $roleModel = new RoleModal();
            $roleModel->createRole($role_name, $role_description);
        }
        header("Location: index.php?page=roles");
    }

    public function edit($id) {
        $roleModel = new RoleModal();
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


            $roleModel = new RoleModal();
            $roleModel->updateRole($id, $role_name, $role_description);
        }

        header("Location: index.php?page=roles");
    }

    public function delete() {
        $roleModel = new RoleModal();
        $roleModel->deleteRoel($_GET['id']);

        header("Location: index.php?page=roles");
    }
}

