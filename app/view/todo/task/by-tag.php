<?php

$title = 'Список задач по тегу';
ob_start();

?>

    <h1>Список задач по тегу: <span>"<?=$tagName;?>"</span></h1>
    <div class="filter-priority">
        <a data-priority="low" class="btn" style="background: #51A5F4">Low</a>
        <a data-priority="medium" class="btn " style="background: #3C7AB5">Medium</a>
        <a data-priority="high" class="btn " style="background: #274F75">High</a>
        <a data-priority="urgent" class="btn " style="background: #122436">Urgent</a>
    </div>
    <div class="accordion" id="tasks-accordion">
        <?php foreach ($tasksByTag as $oneTask): ?>
            <?php
            $priorityColor = '';
            switch ($oneTask['priority']) {
                case 'low':
                    $priorityColor = '#51A5F4';
                    break;
                case 'medium':
                    $priorityColor = '#3C7AB5';
                    break;
                case 'high':
                    $priorityColor = '#274F75';
                    break;
                case 'urgent':
                    $priorityColor = '#122436';
                    break;
            }
            ?>

            <div class="cart-item">

                <h2>
                    <span><strong><?php echo $oneTask['title']; ?> </strong></span>
                    <span> <?php echo $oneTask['status']; ?> </span>
                    <span><span class="due-date"><?php echo $oneTask['finish_date']; ?></span></span>
                </h2>

                <div class="cart-body">
                    <p>
                        <span><strong>Категория:</strong> <?php echo $oneTask['category']['title'] ?? 'N/A'; ?></span>
                        <span><strong>Статус:</strong> <?php echo $oneTask['status']; ?></span>
                    </p>
                    <p>
                        <span style="background: <?=$priorityColor?>;"><strong>Приоритет:</strong> <?php echo $oneTask['priority']; ?></span>
                        <span><strong>Дата окончания:</strong> <?php echo $oneTask['finish_date']; ?></span>
                    </p>
                    <p><strong>Теги:</strong>
                        <?php foreach ($oneTask['tags'] as $tag): ?>
                            <a href="//<?= APP_BASE_PATH ?>/todo/task/by-tag/<?= $tag['id'] ?>" class="tag"><?= $tag['name'] ?></a>
                        <?php endforeach; ?>
                    </p>
                    <p>
                        <strong>Описание:</strong> <em><?php echo $oneTask['description'] ?? ''; ?></em>
                    </p>
                    <hr>
                    <div class="cart-task">

                        <form action="//<?= APP_BASE_PATH ?>/todo/task/update-status/<?php echo $oneTask['id']; ?>" method="POST">
                            <input type="hidden" name="status" value="cancelled">
                            <button type="submit" class="btn <?=$oneTask['status'] == 'cancelled' ? 'btn-dark' : 'btn-secondary';?>">cancelled</button>
                        </form>
                        <form action="//<?= APP_BASE_PATH ?>/todo/task/update-status/<?php echo $oneTask['id']; ?>" method="post">
                            <input type="hidden" name="status" value="new">
                            <button type="submit" class="btn <?=$oneTask['status'] == 'new' ? 'btn-dark' : 'btn-secondary';?>">new</button>
                        </form>
                        <form action="//<?= APP_BASE_PATH ?>/todo/task/update-status/<?php echo $oneTask['id']; ?>" method="post">
                            <input type="hidden" name="status" value="in_progress">
                            <button type="submit" class="btn <?=$oneTask['status'] == 'in_progress' ? 'btn-dark' : 'btn-secondary';?>">in progress</button>
                        </form>
                        <form action="//<?= APP_BASE_PATH ?>/todo/task/update-status/<?php echo $oneTask['id']; ?>" method="post">
                            <input type="hidden" name="status" value="on_hold">
                            <button type="submit" class="btn <?=$oneTask['status'] == 'on_hold' ? 'btn-dark' : 'btn-secondary';?>">on hold</button>
                        </form>
                        <form action="//<?= APP_BASE_PATH ?>/todo/task/update-status/<?php echo $oneTask['id']; ?>" method="post">
                            <input type="hidden" name="status" value="completed">
                            <button type="submit" class="btn <?=$oneTask['status'] == 'completed' ? 'btn-dark' : 'btn-secondary';?>">completed</button>
                        </form>

                        <a href="//<?= APP_BASE_PATH ?>/todo/task/edit/<?php echo $oneTask['id']; ?>" class="btn btn-edit">Редактировать</a>
                        <a href="//<?= APP_BASE_PATH ?>/todo/task/delete/<?php echo $oneTask['id']; ?>" class="btn btn-delete">Удалить</a>
                    </div>

                </div>

            </div>

        <?php endforeach; ?>
    </div>



<?php $content = ob_get_clean();

include 'app/view/layout.php';
?>