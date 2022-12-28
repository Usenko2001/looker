<div class="container">
    <div class="row g-2">
        <div class="col-md-12 mt-5 mb-5">
            <div class="logo-text text-center">
                События камеры <?= $cameraId ?>
            </div>
        </div>
        <div class="col-md-12 d-flex gap-2">
            <a href="/" class="btn btn-outline-secondary">Последние события</a>
        </div>
        <div class="col-md-12">
            Последняя загрузка: <?= date("Y-m-d H:i:s") ?>
        </div>
    </div>
</div>

<div class="container my-3">
    <div class="my-3">
        <?php $this->component('paginator', ['page'=>'/camera.php', 'id'=>$cameraId, 'p'=>$pagination['page'], 'tp'=>$pagination['totalPages']]) ?>
    </div>
    <div class="row g-2">
        <?php foreach ($events as $event){ ?>
            <div class="col-md-4 col-lg-3">
                <a href="/event.php?id=<?= $event['id'] ?>" class="d-block text-decoration-none border rounded-2 p-2 text-dark">
                    <div class="mb-2">
                        Событие #<?= $event['id'] ?>
                    </div>
                    <div class="mb-2">
                        Время: <?= $event['time'] ?>
                    </div>
                    <div class="text-center">
                        <?php if($event['image'] ?? null){ ?>
                            <img src="data:image/jpeg;base64,<?= $event['image']?>"class="w-100" style="object-fit: cover">
                        <?php } else { ?>
                            Ошибка при загрузке изображения
                        <?php }?>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>

    <div class="my-3">
        <?php $this->component('paginator', ['page'=>'/camera.php', 'id'=>$cameraId, 'p'=>$pagination['page'], 'tp'=>$pagination['totalPages']]) ?>
    </div>
</div>