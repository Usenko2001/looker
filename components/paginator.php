<div class="d-flex gap-2">
    <?php if($p <= 1){?>
        <div class="border rounded-2 p-2 text-muted">
            &lt;
        </div>
    <?php } else {?>
        <a href="<?= $page ?>?id=<?= $id?>&page=<?= $p - 1?>"
           class="border rounded-2 p-2 d-block text-decoration-none">&lt;</a>
    <?php } ?>

    <?php if($p == 1){?>
        <div class="border rounded-2 p-2 text-dark border-dark">
            1
        </div>
    <?php } else {?>
        <a href="<?= $page ?>?id=<?= $id?>&page=1"
           class="border rounded-2 p-2 d-block text-decoration-none">1</a>
    <?php } ?>


    <?php if($p == 3){?>
        <a href="<?= $page ?>?id=<?= $id?>&page=<?= $p - 1 ?>"
           class="border rounded-2 p-2 d-block text-decoration-none"><?= $p - 1 ?></a>
    <?php } else if($p > 3) {?>
        <div class="border rounded-2 p-2 text-muted">...</div>
        <a href="<?= $page ?>?id=<?= $id?>&page=<?= $p - 1 ?>"
           class="border rounded-2 p-2 d-block text-decoration-none"><?= $p - 1 ?></a>
    <?php } ?>



    <?php if($p < $tp && $p > 1){?>
        <div class="border rounded-2 p-2 text-dark border-dark"><?= $p ?></div>
    <?php } ?>


    <?php if($p <  $tp - 2) {?>
        <a href="<?= $page ?>?id=<?= $id?>&page=<?= $p + 1 ?>"
           class="border rounded-2 p-2 d-block text-decoration-none"><?= $p + 1 ?></a>
    <?php } ?>

    <?php if($p == $tp-2){?>
        <a href="<?= $page ?>?id=<?= $id?>&page=<?= $p + 1 ?>"
           class="border rounded-2 p-2 d-block text-decoration-none"><?= $p + 1 ?></a>
    <?php } ?>
    <?php if($p < $tp-2){?>
        <div class="border rounded-2 p-2 text-muted">...</div>
    <?php } ?>

    <?php if($p == $tp){?>
        <div class="border rounded-2 p-2 text-dark border-dark"><?= $p ?></div>
    <?php } else {?>
        <a href="<?= $page ?>?id=<?= $id?>&page=<?= $tp ?>"
           class="border rounded-2 p-2 d-block text-decoration-none"><?= $tp ?></a>
    <?php } ?>

    <?php if($p >= $tp){?>
        <div class="border rounded-2 p-2 text-muted">
            &gt;
        </div>
    <?php } else {?>
        <a href="<?= $page ?>?id=<?= $id?>&page=<?= $p + 1?>"
           class="border rounded-2 p-2 d-block text-decoration-none">&gt;</a>
    <?php } ?>

</div>