<?php

$title = 'Редактирование задачи';
ob_start();

?>

    <h1>Редактирование задачи</h1>
    <form class="form" action="//<?= APP_BASE_PATH ?>/todo/task/update" method="POST">
        <input type="hidden" name="id" value="<?= $task['id'] ?>">
        <div>

            <div>
                <label for="title">Заголовок</label>
                <input type="text" id="title" name="title" value="<?= $task['title'] ?>" required>
            </div>

            <div>
                <label for="reminder_at">Напомнить за</label>
                <select id="reminder_at" name="reminder_at">
                    <option value="30_minutes">30 минут</option>
                    <option value="1_hour">1 час</option>
                    <option value="2_hours">2 часа</option>
                    <option value="12_hours">12 часов</option>
                    <option value="24_hours">24 часа</option>
                    <option value="7_days">7 дней</option>
                </select>
            </div>
        </div>

        <div>
            <div>
                <label for="category_id">Категория</label>
                <select id="category_id" name="category_id" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" <?= $category['id'] == $task['category_id'] ? 'selected' : '' ?>><?= $category['title'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="col-12 col-md-6 mb-3">
                <label for="finish_date">Дата окончания</label>
                <input type="datetime-local" id="finish_date" name="finish_date" value="<?= $task['finish_date'] !== null ? str_replace(' ', 'T', $task['finish_date']) : '' ?>" required>
            </div>
        </div>

        <div>
            <div>
                <label for="status">Статус</label>
                <select id="status" name="status" required>
                    <option value="new" <?= $task['status'] == 'new' ? 'selected' : '' ?>>Новая</option>
                    <option value="in_progress" <?= $task['status'] == 'in_progress' ? 'selected' : '' ?>>В процессе</option>
                    <option value="completed" <?= $task['status'] == 'completed' ? 'selected' : '' ?>>Выполнена</option>
                    <option value="on_hold" <?= $task['status'] == 'on_hold' ? 'selected' : '' ?>>Остановленна</option>
                    <option value="cancelled" <?= $task['status'] == 'cancelled' ? 'selected' : '' ?>>Отменена</option>
                </select>
            </div>

            <div>
                <label for="priority">Приоритет</label>
                <select id="priority" name="priority" required>
                    <option value="low" <?= $task['priority'] == 'low' ? 'selected' : '' ?>>Низкий</option>
                    <option value="medium" <?= $task['priority'] == 'medium' ? 'selected' : '' ?>>Средний</option>
                    <option value="high" <?= $task['priority'] == 'high' ? 'selected' : '' ?>>Высокий</option>
                    <option value="urgent" <?= $task['priority'] == 'urgent' ? 'selected' : '' ?>>Особый</option>
                </select>
            </div>
        </div>

        <div>
            <div >
                <label for="tags">Теги</label>
                <div class="tags-container form-control">
                    <?php
                    $tagNames = array_map(function ($tag) {
                        return $tag['name'];
                    }, $tags);
                    foreach ($tagNames as $tagName) {
                        echo "<div class='tag'>
                            <span>$tagName</span>
                            <button type='button'>×</button>
                        </div>";
                    }
                    ?>
                    <input class="form-control" type="text" id="tag-input">
                </div>
                <input class="form-control" type="hidden" name="tags" id="hidden-tags" value="<?=implode(', ', $tagNames) ?>">
            </div>

            <div>
                <label for="description">Описание</label>
                <textarea id="description" name="description" rows="3"><?php echo $task['description'] ?? ''; ?></textarea>
            </div>
        </div>

        <div>
            <div>
                <button type="submit" class="btn ">Обновить задачу</button>
            </div>
        </div>
    </form>
    <script>
        const tagInput = document.querySelector('#tag-input');
        const tagsContainer = document.querySelector('.tags-container');
        const hiddenTags = document.querySelector('#hidden-tags');
        const existingTags = '<?= isset($task['tags']) ? $task['tags'] : ''?>';

        function createTag(text) {
            const tag = document.createElement('div');
            tag.classList.add('tag');
            const tagText = document.createElement('span');
            tagText.textContent = text;

            const closeButton = document.createElement('button');
            closeButton.innerHTML = '&times;';

            closeButton.addEventListener('click', () => {
                tagsContainer.removeChild(tag);
                updateHiddenTags();
            });

            tag.appendChild(tagText);
            tag.appendChild(closeButton);

            return tag;
        }

        function updateHiddenTags(){
            const tags = tagsContainer.querySelectorAll('.tag span');
            const tagText = Array.from(tags).map(tag => tag.textContent);
            hiddenTags.value = tagText.join(',');
        }

        tagInput.addEventListener('input', (e) => {
            if(e.target.value.includes(',')){
                const tagText = e.target.value.slice(0, -1).trim();
                if (tagText.length > 1) {
                    const tag = createTag(tagText);
                    tagsContainer.insertBefore(tag, tagInput);
                    updateHiddenTags();
                }
                e.target.value = '';
            }
        });

        tagsContainer.querySelectorAll('.tag button').forEach(button =>{
            button.addEventListener('click', () => {
                tagsContainer.removeChild(button.parentElement);
                updateHiddenTags();
            });
        });

    </script>

<?php $content = ob_get_clean();
include 'app/view/layout.php';
?>