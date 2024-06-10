<?php

$title = 'Создание категории';
ob_start();
?>

    <h1>Создание категории</h1>
    <form class="form" method="POST" id="createCategoryForm">
        <!--action="//<?php /*= APP_BASE_PATH */ ?>/todo/category/store"-->>
        <div>
            <label for="title" class="form-label">Заголовок</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div>
            <label for="description" class="form-label">Описание</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Создать категорию</button>
    </form>

    <div id="categoryModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modalMessage"></p>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#createCategoryForm').on('submit', function (event) {
                event.preventDefault();

                const formData = {
                    title: $('#title').val(),
                    description: $('#description').val()
                };

                const url = 'http://<?= APP_BASE_PATH ?>/todo/category/store'

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function (response) {

                        $('#modalMessage').text(response.message);

                        $('#categoryModal').show();

                    },
                    error: function (xhr, status, error) {
                        $('#modalMessage').text('Ошибка при создании категории.');
                        $('#categoryModal').show();
                    }
                });
            });

            $('.close').on('click', function () {
                $('#categoryModal').hide();
                location = 'http://localhost/CRM/todo/category'
            });
        });

    </script>

<?php $content = ob_get_clean();

include 'app/view/layout.php';
?>