<?php

namespace model\check;

class CheckModel
{
    public function getCurrentUrlSlug()
    {
        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $parsedUrl = parse_url($url);
        $path = $parsedUrl['path'];
        $slug = str_replace(APP_BASE_PATH, '', $path);
        return ltrim($slug, '/');
    }

    public function checkPermission($slug)
    {
        // Получить информацию о странице по slug
        $pageModel = new PageModel();
        $page = $pageModel->findBySlug($slug);
        if (!$page) {
            return false;
        }
        // Получить разрешенные роли для страницы
        $allowedRoles = explode(',', $page['role']);
        // Проверить, имеет ли текущий пользователь доступ к странице
        if (isset($this->userRole) && in_array($this->userRole, $allowedRoles)) {
            return true;
        } else {
            return false;
        }
    }

}