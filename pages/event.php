<div class="container my-3">
  <div class="row">
    <div class="col-md-6">
      <a href="/" class="btn btn-outline-secondary">Последние события</a>
    </div>
  </div>
</div>

<div class="container my-3">
    <h5>
      Событие #<?= $id ?>
    </h5>
    <div class="row g-2">
      <div class="col-md-4 text-start">
        <?php if($page > 1) { ?>
        <a href="/event.php?id=<?=$id?>&page=<?=$page-1?>" class="btn btn-outline-secondary">&lt;</a>
        <?php } ?>
      </div>
      <div class="col-md-4 text-center">
        <?php if($page > 1) { ?>
          <a href="/event.php?id=<?=$id?>" class="btn btn-outline-secondary">В начало</a>
        <?php } ?>
      </div>
      <div class="col-md-4 text-end">
        <?php if($page < $totalPages) { ?>
          <a href="/event.php?id=<?=$id?>&page=<?=$page+1?>" class="btn btn-outline-secondary">&gt;</a>
        <?php } ?>
      </div>
      
      <div class="col-12 col-md-8 offset-md-2">
        <?php if($image){ ?>
            <img src="data:image/jpeg;base64,<?= $image['image']?>" alt="" class="w-100 " style="object-fit: contain">
        <?php } else { ?>
            <div class="text-center my-3">Нет изображения!</div>
        <?php } ?>
      </div>
      
    </div>
</div>