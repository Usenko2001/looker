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
                <?php $this->component('imagecard', ['event'=>$event]) ?>
            </div>
        <?php } ?>
    </div>

    <div class="my-3">
        <?php $this->component('paginator', ['page'=>'/camera.php', 'id'=>$cameraId, 'p'=>$pagination['page'], 'tp'=>$pagination['totalPages']]) ?>
    </div>
</div>