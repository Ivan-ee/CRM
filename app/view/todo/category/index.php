<?php

$title = 'КАтегории';
ob_start();
?>

    <h1>Категории</h1>
    <a href="//<?= APP_BASE_PATH ?>/todo/category/create" class="btn btn-create">Создать категорию</a>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Заголовок</th>
            <th>Описание</th>
            <th>Активная</th>
            <th>Дейвтсвие</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $category): ?>
            <tr data-id="<?= $category['id'] ?>">
                <td><?= $category['id'] ?></td>
                <td><?= $category['title'] ?></td>
                <td><?= $category['description'] ?></td>
                <td><?= $category['usability'] == 1 ? 'Yes' : 'No' ?></td>
                <td>
                    <a href="//<?= APP_BASE_PATH ?>/todo/category/edit/<?= $category['id'] ?>" class="btn btn-edit">Редактировать</a>
                    <a href="//<?= APP_BASE_PATH ?>/todo/category/delete/<?= $category['id'] ?>" class="btn btn-delete">Удалить</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div id="categoryModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modalMessage"></p>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.btn-delete').on('click', function (event) {
                event.preventDefault();

                const url = $(this).attr('href');

                $.ajax({
                    type: 'POST',
                    url: url,
                    success: function (response) {

                        if (response.status === 'success') {
                            $(`tr[data-id="${response.id}"]`).remove();
                        }

                        $('#modalMessage').text(response.message);
                        $('#categoryModal').show();
                    },
                    error: function (xhr, status, error) {
                        $('#modalMessage').text('Ошибка при удалении категории.');
                        $('#categoryModal').show();
                    }
                });
            });

            $('.close').on('click', function () {
                $('#categoryModal').hide();
            });
        });
    </script>


<?php $content = ob_get_clean();

include 'app/view/layout.php';
?>