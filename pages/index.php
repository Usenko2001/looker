<div class="container">
    <div class="row g-2">

        <div class="col-md-12 mt-5 mb-5">
            <div class="logo-text text-center">
                диспетчер событий
            </div>
        </div>

      <div class="col-md-12">
        Последняя загрузка: <?= date("Y-m-d H:i:s") ?>
      </div>
<!--      <div class="col-md-12">-->
<!--        Загрузка страницы: --><?//= $loadTime ?><!-- сек.-->
<!--      </div>-->
        <div class="col-md-12">
<!--                    <button class="btn-head">-->
<!--                        параметры-->
<!--                    </button>-->

            <a href="/" class="btn btn-outline-secondary">
                обновить
            </a>
        </div>
    </div>
</div>

<div class="container my-3">
    <h5>
      Последние события
    </h5>
    <div class="row g-2">
        <div class="col-12 gap-2 d-md-flex justify-content-between">
            <h3>
              Камера общего плана
            </h3>

            <div>
                (<a href="/camera.php?id=1">все события камеры</a>)
            </div>
        </div>
        <?php foreach ($events1 as $event){ ?>
          <div class="col-md-4 col-lg-3">
            <?php $this->component('imagecard', ['event'=>$event]) ?>
          </div>
        <?php } ?>
        <div class="col-12 gap-2 d-md-flex justify-content-between">
            <h3>
              Камера тамбура
            </h3>
            <div>
                (<a href="/camera.php?id=8">все события камеры</a>)
            </div>


        </div>
        <?php foreach ($events2 as $event){ ?>
          <div class="col-md-4 col-lg-3">
              <?php $this->component('imagecard', ['event'=>$event, 'noimage'=>true]) ?>
          </div>
        <?php } ?>
    </div>
</div>