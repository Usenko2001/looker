<a href="/event.php?id=<?= $event['id'] ?>" class="d-block text-decoration-none border rounded-2 p-2 text-dark">
    <div class="mb-2">
        Событие #<?= $event['id'] ?>
    </div>
    <div class="mb-2">
        Время: <?= $event['time'] ?>
    </div>
    <?php if(!isset($noimage) || !$noimage) { ?>
        <div class="text-center">
            <?php if($thumb = getThumbImageForEvent($event['id'], $event['image'] ?? null)){ ?>
                <img src="<?= $thumb?>" class="w-100" style="object-fit: cover">
            <?php } else { ?>
                Ошибка при загрузке изображения
            <?php }?>
        </div>
    <?php } ?>
</a>