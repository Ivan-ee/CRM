<?php

$title = 'Редактирование категории';
ob_start();
?>

    <h1>Редактирование категории</h1>
    <form class="form" id="editCategoryForm" method="POST"
          action="//<?= APP_BASE_PATH ?>/todo/category/update/<?php echo $category['id']; ?>">
        <input type="hidden" name="id" value="<?= $category['id'] ?>">
        <div>
            <label for="title">Заголовок</label>
            <input type="text" id="title" name="title" value="<?= $category['title'] ?>" required>
        </div>
        <div class="mb-3">
            <label for="description">Описание</label>
            <textarea id="description" name="description" required><?= $category['description'] ?></textarea>
        </div>
        <div class="form-checkbox">
            <input type="checkbox" id="category_usability" name="usability"
                   value="1" <?php echo $category['usability'] ? ' checked' : ''; ?>>
            <label for="category_usability">Активная</label>
        </div>
        <button type="submit" class="btn btn-create">Обновить категорию</button>
    </form>

    <div id="categoryModal" class="modal" style="display:none;">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modalMessage"></p>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('#editCategoryForm').on('submit', function (event) {
                event.preventDefault();

                const formData = {
                    id: $('input[name="id"]').val(),
                    title: $('#title').val(),
                    description: $('#description').val(),
                    usability: $('#category_usability').is(':checked') ? 1 : 0
                };

                const url = 'http://<?= APP_BASE_PATH ?>/todo/category/update/' + formData.id;

                $.ajax({
                    type: 'POST',
                    url: url,
                    data: formData,
                    success: function (response) {

                        $('#modalMessage').text(response.message);

                        $('#categoryModal').show();
                    },
                    error: function (xhr, status, error) {
                        $('#modalMessage').text('Ошибка при обновлении категории.');
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