async function loadImage(parentId, page = 1, perPage = 5){
    let parent = $(`#${parentId}`)
    if(!parent.length)
        return;
    let event = parent.data('event');

    let img = $(`#${parentId} img`);
    let loader = $(`#${parentId} .spinner-border`);
    let error = $(`#${parentId} .error`);


    img.addClass('d-none');
    error.addClass('d-none');
    loader.removeClass('d-none');

    fetch(`/api/event.php?id=${event}&page=${page}`)
        .then((res)=>res.json())
        .then((data)=>{
            // console.log(data);
            if(data.image) {
                img.attr('src', 'data:image/jpeg;base64,' + data.image)
                img.removeClass('d-none');
            } else {
                error.removeClass('d-none');
                error.html("Ошибка: " + data.error);
            }
        })
        .finally(()=>{
            loader.addClass('d-none')
        });

}


