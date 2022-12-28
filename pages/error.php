
<?php /** @var Exception|Error $ex */ ?>
<div class="container my-3" style="min-height: 100vh">
    <div style="min-height: 100vh">
        <div class="my-3">
            <span class="font-weight-bold">Error: </span>
            <?= $ex->getMessage() ?>
            <span class="font-weight-bold"> in <?=$ex->getFile()?> at line <?= $ex->getLine() ?> </span>
        </div>
        <div class="text-center my-3">
            <?php foreach ($ex->getTrace() as $line) { ?>
            <div class="my-1 text-muted"><?= $line ?></div>
            <?php } ?>
        </div>
    </div>
</div>