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
                <input type="datetime-local" id="finish_date" name="finish_date" >
            </div>
        </div>
        <div>
            <label for="description">Описание</label>
            <textarea id="description" name="description" rows="3" required><?php echo $task['description'] ?? ''; ?></textarea>
        </div>
        <button type="submit" class="btn btn-create">Создать задачу</button>
    </form>

<?php $content = ob_get_clean();

include 'app/view/layout.php';
?>