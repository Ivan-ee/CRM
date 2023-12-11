<?php

$title = 'Создание задачи';
ob_start();
?>

    <h1 class="mb-4">Создание задачи</h1>
    <form class="form" method="POST" action="//<?= APP_BASE_PATH ?>/todo/task/store">
        <div>
            <div>
                <label for="title">Заголовок</label>
                <input type="text" id="title" name="title" required>
            </div>
        </div>
        <div>
            <div>
                <label for="category_id">Категория</label>
                <select id="category_id" name="category_id" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>"><?= $category['title'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div >
                <label for="finish_date">Дата окончания</label>
                <input type="text" id="finish_date" name="finish_date" >
            </div>
        </div>
        <button type="submit" class="btn btn-create">Создать задачу</button>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function(){
            flatpickr("#finish_date",{
                enableTime: true,
                noCalendar: false,
                dateFormat: "Y-m-d H:00:00",
                time_24hr: true,
                minuteIncrement: 60
            });
        });
    </script>

<?php $content = ob_get_clean();

include 'app/view/layout.php';
?>