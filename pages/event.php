<div class="container my-3">
  <div class="d-flex gap-2">
      <a href="/" class="btn btn-outline-secondary">Последние события</a>
      <a href="/camera.php?id=<?= $event['camera_id']?>" class="btn btn-outline-secondary">Все события камеры #<?= $event['camera_id']?></a>
  </div>
</div>
<script>
  let currentpage = 1;
  const maxpage = <?= $totalPages ?>;
  function checkDisableBtn(){
      let btnNext = $('#btnNext');
      btnNext.attr('disabled', currentpage >= maxpage);

      let btnPrev = $('#btnPrev');
      btnPrev.attr('disabled', currentpage === 1);
  }
  function nextpage(){
      currentpage+=1;
      currentpage = Math.min(maxpage, currentpage)
      checkDisableBtn();

      loadImage('eventImg', currentpage);
  }
  function prevpage(){
      currentpage-=1;
      currentpage = Math.max(1, currentpage)
      checkDisableBtn();

      loadImage('eventImg', currentpage);
  }
</script>

<div class="container my-3">
    <h5>
      Событие #<?= $id ?>
    </h5>
    <div>
    </div>
    <div class="row g-2">
      <div class="col-md-4 text-start">
        <button class="btn btn-outline-secondary" id="btnPrev" onclick="prevpage()">&lt;</button>
      </div>
      <div class="col-md-4 text-center">
<!--        --><?php //if($page > 1) { ?>
<!--          <a href="/event.php?id=--><?//=$id?><!--" class="btn btn-outline-secondary">В начало</a>-->
<!--        --><?php //} ?>
      </div>
      <div class="col-md-4 text-end">
        <button class="btn btn-outline-secondary" id="btnNext" onclick="nextpage()">&gt;</button>
      </div>
      
      <div class="col-12">
          <div id="eventImg" class="d-flex w-100 align-items-center justify-content-center my-4" data-event="<?=$id?>">
            <div class="error d-none">
              Ошибка!
            </div>
            <img src="#" alt="" class="w-100 d-none " style="object-fit: contain">
            <div class="spinner-border text-secondary text-center" role="status">
              <span class="sr-only">Loading...</span>
            </div>
          </div>

      </div>
      
    </div>
</div>

<script>
    $( document ).ready(()=>{
        checkDisableBtn();
        loadImage('eventImg')
    })
</script>