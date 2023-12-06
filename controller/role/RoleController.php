<?php

namespace controller\role;

use model\role\RoleModal;

require_once 'model/role/RoleModal.php';

class RoleController
{
    public function index()
    {
        $userModel = new RoleModal();
        $roles = $userModel->getAllRoles();

        include 'app/view/roles/index.php';
    }

    public function create()
    {
        include 'app/view/roles/create.php';
    }

    public function store()
    {
        if (isset($_POST['role_name']) && isset($_POST['role_description'])) {
            $role_name = $_POST['role_name'];
            $role_description = $_POST['role_description'];

            if (empty($role_name)) {
                echo "Название роли не заполнено.";
                return;
            }

            $roleModel = new RoleModal();
            $roleModel->createRole($role_name, $role_description);
        }
        header("Location: index.php?page=role");
    }

    public function edit($id)
    {
        $roleModel = new RoleModal();
        $role = $roleModel->getRoleById($id);

        if (!$role) {
            echo "Роль не найдена.";
            return;
        }

        include 'app/view/roles/edit.php';
    }

    public function update()
    {
        if (isset($_POST['id']) && isset($_POST['role_name']) && isset($_POST['role_description'])) {
            $id = $_POST['id'];
            $role_name = $_POST['role_name'];
            $role_description = $_POST['role_description'];


            $roleModel = new RoleModal();
            $roleModel->updateRole($id, $role_name, $role_description);
        }

        header("Location: index.php?page=role");
    }

    public function delete()
    {
        $roleModel = new RoleModal();
        $roleModel->deleteRole($_GET['id']);

        header("Location: index.php?page=role");
    }
}

