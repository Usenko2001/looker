<div class="container">
    <div class="row g-2">
        <div class="col-md-12 mt-5 mb-5">
            <div class="logo-text text-center">
                События камеры <?= $cameraId ?>
            </div>
        </div>
        <div class="col-md-12">
            Последняя загрузка: <?= date("Y-m-d H:i:s") ?>
        </div>
    </div>
</div>

<div class="container my-3">
    <div class="my-3">
        <?php $this->component('paginator', ['cameraId'=>$cameraId, 'p'=>$pagination['page'], 'tp'=>$pagination['totalPages']]) ?>
    </div>
    <?php foreach ($events as $event){ ?>
        <div class="my-1">
            <a href="/event.php?id=<?= $event['id']?>">
                Событие #<?= $event['id'] ?> от <?= $event['time'] ?>
            </a>
        </div>
    <?php } ?>

    <div class="my-3">
        <?php $this->component('paginator', ['cameraId'=>$cameraId, 'p'=>$pagination['page'], 'tp'=>$pagination['totalPages']]) ?>
    </div>
</div>