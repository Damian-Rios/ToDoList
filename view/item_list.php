<?php
// Include the header part of the HTML page
include("view/header.php");
?>

<!-- Display ToDo List Items -->
<?php if (!empty($items)) : ?>
    <section id="list" class="main">
        <?php foreach ($items as $item) : ?>
            <div class="tasks">
                <div>
                    <h3 class="item-title"><?= htmlspecialchars($item['Title']) ?></h3>
                    <p class="item-description"><?= htmlspecialchars($item['Description']) ?></p>
                </div>
                <div>
                    <form action="." method="post">
                        <input type="hidden" name="action" value="delete_item">
                        <input type="hidden" name="item_num" value="<?= $item['ItemNum'] ?>">
                        <button class="remove-button">X</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
<?php else : ?>
    <p class="main">No items exist yet</p>
<?php endif; ?>

<!-- Add ToDo Item Form -->
<section class="add-item">
    <h2>Add Item</h2>
    <form action="." method="post">
        <input type="text" name="item_title" maxlength="20" placeholder="Title" required>
        <input type="text" name="description" maxlength="50" placeholder="Description" required>
        <button type="submit" name="action" value="add_item">Add Item</button>
    </form>
</section>

<?php
// Include the footer part of the HTML page
include("view/footer.php");
?>
