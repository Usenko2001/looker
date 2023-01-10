<div class="container my-3">
  <div class="d-flex gap-2">
      <a href="/" class="btn btn-outline-secondary">Последние события</a>
      <a href="/camera.php?id=<?= $event['camera_id']?>" class="btn btn-outline-secondary">Все события камеры #<?= $event['camera_id']?></a>
  </div>
</div>

<div class="container my-3">
    <h5>
      Событие #<?= $id ?>
    </h5>
    <div>
    </div>
    <div class="row g-2">
        <div class=" col-12">
            <?php if($totalPages > 1) { ?>
                <div class="my-3">
                    <?php $this->component('paginator', ['page'=>'/event.php', 'id'=>$id, 'p'=>$page, 'tp'=>$totalPages]) ?>
                </div>
            <?php } ?>
        </div>
      
        <div class="col-12">
            <div id="carouselExampleControls" class="carousel slide" data-bs-interval="3600000" data-bs-ride="true"  data-bs-touch="false">

                <?php $first = true;$num = 0;?>
                <div class="carousel-indicators">
                    <?php foreach ($images as $img) { ?>
                        <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="<?= $num ?>"
                              <?php if($first){ ?> class="active" aria-current="true" <?php } ?>

                              aria-label="Slide <?= $num ?>"></button>
                    <?php ; $first = false;$num++;} ?>
                </div>
                <?php $first = true;$num = 0;?>
                <div class="carousel-inner">
                    <?php foreach ($images as $img) { ?>
                        <div class="carousel-item <?= $first ? 'active' : '' ?>">
                            <img src="data:image/jpeg;base64,<?=$img['image']?>" class="d-block w-100" alt="...">
                        </div>
                    <?php ; $first = false; $num++;} ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

        </div>


        <div class=" col-12">
            <?php if($totalPages > 1) { ?>
                <div class="my-3">
                    <?php $this->component('paginator', ['page'=>'/event.php', 'id'=>$id, 'p'=>$page, 'tp'=>$totalPages]) ?>
                </div>
            <?php } ?>
        </div>
    </div>
</div>