<?php

namespace controller\role;

use model\role\RoleModel;

require_once 'model/role/RoleModel.php';

class RoleController
{
    public function index()
    {
        $userModel = new RoleModel();
        $roles = $userModel->getAllRoles();

        include 'app/view/role/index.php';
    }

    public function create()
    {
        include 'app/view/role/create.php';
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

            $roleModel = new RoleModel();
            $roleModel->createRole($role_name, $role_description);
        }

        $path = '//' . APP_BASE_PATH . '/role';
        header("Location: $path");
    }

    public function edit($params)
    {
        $roleModel = new RoleModel();
        $role = $roleModel->getRoleById($params['id']);

        if (!$role) {
            echo "Роль не найдена.";
            return;
        }

        include 'app/view/role/edit.php';
    }

    public function update($params)
    {
        if (isset($params['id']) && isset($_POST['role_name']) && isset($_POST['role_description'])) {
            $id = $params['id'];
            $role_name = $_POST['role_name'];
            $role_description = $_POST['role_description'];


            $roleModel = new RoleModel();
            $roleModel->updateRole($id, $role_name, $role_description);
        }

        $path = '//' . APP_BASE_PATH . '/role';
        header("Location: $path");
    }

    public function delete($params)
    {
        $roleModel = new RoleModel();
        $roleModel->deleteRole($params['id']);

        $path = '//' . APP_BASE_PATH . '/role';
        header("Location: $path");
    }
}

