<div class="container">
    <div class="row">

        <div class="col-md-12 mt-5 mb-5">
            <div class="logo-text text-center">
                диспетчер событий
            </div>
        </div>

        <div class="col-md-12">
            <div class="">

                <div class="col-md-6">
                    <button class="btn-head">
                        параметры
                    </button>

                    <button class="btn-head ms-5">
                        обновить
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>

<div class="container my-3">
    <h5>
      Последние события
    </h5>
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
            </a>
          </div>
        <?php } ?>
    </div>
</div>