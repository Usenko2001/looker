<div class="container my-3">
  <div class="d-flex gap-2">
      <a href="/" class="btn btn-outline-secondary">Последние события</a>
      <a href="/camera.php?id=<?= $event['camera_id']?>" class="btn btn-outline-secondary">Все события камеры #<?= $event['camera_id']?></a>
  </div>
</div>
<script>
    function tryCacheImages(){
      let loader = $('#loadIndicator');
      let btn = $('#btnCache');
      loader.removeClass('d-none');
      btn.hide();
      fetch("/cron/cache_events.php?event=<?= $id ?>")
        .then(r => {
          if(r.ok)
            location.reload();
          else
            alert("Error while caching images! Error " + r.status + ", " + r.statusText)
      }).finally(()=>{
        loader.addClass('d-none');
        btn.show();
      })
    }

    function loadBigImage(imageId){
        let modal = $('#fullImageModal');
        let imgContainer = $('#fullImageContainer');
        let img = $('#fullImage');
        let loader = $('#fullImageLoader');
        let text = $('#fullImageText');
        text.html("ID: " + imageId)
        modal.modal('show');
        loader.removeClass('d-none');
        imgContainer.addClass('d-none');
        fetch('/api/image.php?id=' + imageId)
          .then(r => r.json())
          .then(data => {
            if(data.image){
              img.attr('src', "data:image/jpg;base64,"+data.image)
            }
          })
          .finally(()=>{
            loader.addClass('d-none');
            imgContainer.removeClass('d-none')
          });
    }
</script>

<div class="container my-3">
    <h5>
      Событие #<?= $id ?>
    </h5>
    <div>
    </div>
    <div class="row g-2">

        <?php if(count($images) == 0) {?>
            <div class="text-center my-3">
                Изображения не закэшированы или уже удалены с сервера (изображения удаляются после нескольких дней хранения)<br>
            </div>
            <div class="text-center">
                <div id="loadIndicator" class="d-none">
                    <div class="spinner-border text-secondary" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <button id="btnCache" class="btn btn-outline-secondary" type="button" onclick="tryCacheImages()">Кэшировать</button>
            </div>
        <?php } else { ?>
      
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
                        <?php foreach ($images as $id => $img) { ?>
                            <div class="carousel-item position-relative <?= $first ? 'active' : '' ?>">
                                <button class="btn btn-secondary btn-sm position-absolute top-0 start-50"
                                style="transform: translateX(-50%);" onclick="loadBigImage(<?= $id ?>)">
                                    FullHD
                                </button>
                                <img src="<?=$img?>" class="d-block w-100" alt="...">
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
        <?php } ?>
    </div>
</div>
<div>
    <div class="modal fade" id="fullImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen" role="document">
            <div class="modal-content position-relative">
                <button type="button" class="btn-close position-absolute p-2 top-0 end-0 border rounded-2 bg-white"  style="z-index: 50"
                        data-bs-dismiss="modal" aria-label="Close"></button>

                <div class="modal-body" >
                    <div id="fullImageText" class="text-center">

                    </div>
                    <div id="fullImageLoader" class="d-none text-center">
                        <div class="spinner-border text-secondary" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    </div>
                    <div id="fullImageContainer" class="d-none">
                        <img src="#" id="fullImage" class="w-100" style="object-fit: contain" alt="">
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                </div>
            </div>
        </div>
    </div>
</div>