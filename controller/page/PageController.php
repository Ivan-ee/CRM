<?php

namespace controller\page;

use model\check\CheckModel;
use model\page\PageModel;
use model\role\RoleModel;


class PageController
{
    private $check;

    public function __construct() {
        $this->check = new CheckModel();
    }

    public function index()
    {
        $slug = $this->check->getCurrentUrlSlug();
        var_dump($slug);

        if (!$this->checkPermission($slug)){
            $path = '//' . APP_BASE_PATH;
            header("Location: $path");
            return;
        }

        $pageModel = new PageModel();
        $pages = $pageModel->getAllPages();

        include 'app/view/page/index.php';
    }

    public function create()
    {
        $roleModel = new RoleModel();
        $roles = $roleModel->getAllRoles();

        include 'app/view/page/create.php';
    }

    public function store()
    {
        if (isset($_POST['title']) && isset($_POST['slug']) && isset($_POST['roles'])) {
            $title = $_POST['title'];
            $slug = $_POST['slug'];
            $roles = implode(",", $_POST['roles']);

            $pageModel = new PageModel();
            $pageModel->createPage($title, $slug, $roles);
        }

        $path = '//' . APP_BASE_PATH . '/page';
        header("Location: $path");
    }

    public function edit($params)
    {
        $roleModel = new RoleModel();
        $roles = $roleModel->getAllRoles();

        $pageModel = new PageModel();
        $page = $pageModel->getPageById($params['id']);

        if (!$page) {
            echo "Page не найдена.";
            return;
        }

        include 'app/view/page/edit.php';
    }

    public function update($params)
    {
        if (isset($params['id']) && isset($_POST['title']) && isset($_POST['slug']) && isset($_POST['roles'])) {
            $id = $params['id'];
            $title = $_POST['title'];
            $slug = $_POST['slug'];
            $roles = implode(",", $_POST['roles']);

            if (empty($title) || empty($slug)) {
                echo "Title and Slug or Role fields are required!";
                return;
            }

            $pageModel = new PageModel();
            $pageModel->updatePage($id, $title, $slug, $roles);
        }
        $path = '//' . APP_BASE_PATH . '/page';
        header("Location: $path");
    }

    public function delete($params)
    {
        $this->check->requirePermission();

        $pageModel = new PageModel();
        $pageModel->deletePage($params['id']);

        $path = '//' . APP_BASE_PATH . '/page';
        header("Location: $path");
    }
}

