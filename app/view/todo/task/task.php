<?php

$title = 'Задачи';
ob_start();
?>

<div>
    <div>
        <h1>
            <strong><?php echo $task['title']; ?> </strong>
        </h1>
    </div>

    <div class="card-body">
        <p>
            <span<strong>Category:</strong> <?php echo $category['title'] ?? 'N/A'; ?></span>
            <span><strong>Status:</strong> <?php echo $task['status']; ?></span>
        </p>
        <p>
            <span><strong>Priority:</strong> <?php echo $task['priority']; ?></span>
            <span><strong>Start Date:</strong> <?php echo $task['created_at']; ?></span>
        </p>
        <p>
            <span><strong>Updated:</strong> <?php echo $task['updated_at']; ?></span>
            <span><strong>Due Date:</strong> <?php echo $task['finish_date']; ?></span>
        </p>
        <p><strong>Tags:</strong>
            <?php foreach ($tags as $tag): ?>
                <a href="//<?= APP_BASE_PATH ?>/todo/task/by-tag/<?= $tag['id'] ?>" class="tag"><?= $tag['name'] ?></a>
            <?php endforeach; ?>
        </p>
        <hr>
        <p><strong>Description:</strong> <em><?php echo $task['description'] ?? ''; ?></em></p>
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

<?php $content = ob_get_clean();

include 'app/view/layout.php';
?>
