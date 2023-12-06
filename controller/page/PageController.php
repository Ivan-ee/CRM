<?php

namespace controller\page;

use model\page\PageModel;


class PageController
{
    public function index()
    {
        $pageModel = new PageModel();
        $pages = $pageModel->getAllPages();

        include 'app/view/page/index.php';
    }

    public function create()
    {
        include 'app/view/page/create.php';
    }

    public function store()
    {
        if (isset($_POST['title']) && isset($_POST['slug'])) {
            $title = $_POST['title'];
            $slug = $_POST['slug'];

            $pageModel = new PageModel();
            $pageModel->createPage($title, $slug);
        }

        $path = '//' . APP_BASE_PATH . '/page';
        header("Location: $path");
    }

    public function edit($params)
    {
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
        if (isset($params['id']) && isset($_POST['title']) && isset($_POST['slug'])) {
            $id = $params['id'];
            $title = $_POST['title'];
            $slug = $_POST['slug'];

            if (empty($title) || empty($slug)) {
                echo "Title and Slug or Role fields are required!";
                return;
            }

            $pageModel = new PageModel();
            $pageModel->updatePage($id, $title, $slug);
        }
        $path = '//' . APP_BASE_PATH . '/page';
        header("Location: $path");
    }

    public function delete($params)
    {
        $this->check->requirePermission();

        $pageModel = new PageModel();
        $pageModel->deletePage($params['id']);

        $path = '/' . APP_BASE_PATH . '/page';
        header("Location: $path");
    }
}

