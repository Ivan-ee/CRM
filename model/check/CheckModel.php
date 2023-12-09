<?php

namespace model\check;

use model\page\PageModel;

class CheckModel
{
    private $userRole;

    public function __construct($userRole)
    {
        $this->userRole = $userRole;
    }

    public function getCurrentUrlSlug()
    {
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parsedUrl = parse_url($url);
        $path = $parsedUrl['path'];

        $segments = explode('/', ltrim($path, '/'));
        $firstTwoSegments = array_slice($segments, 0, 2);
        $slug = implode('/', $firstTwoSegments);
        return $slug;
    }

    public function checkPermission($slug)
    {
        $pageModel = new PageModel();
        $page = $pageModel->findBySlug($slug);

        if (!$page) {
            return false;
        }

        $allowedRoles = explode(',', $page['role']);
        if (isset($this->userRole) && in_array($this->userRole, $allowedRoles)) {
            return true;
        } else {
            return false;
        }
    }

    public function requirePermission()
    {
        $slug = $this->getCurrentUrlSlug();

        if (!$this->checkPermission($slug)) {

            $path = '//' . APP_BASE_PATH;
            header("Location: $path");
            exit();
        }
    }

    public function isCurrentUserRole($role)
    {
        return $this->userRole == $role;
    }


}