function openGallery(data) {
    var $link  = data.attr('gallery-image-link'),
        $image = data.attr('gallery-image'),
        $id    = data.attr('gallery-id'),
        $title = data.attr('gallery-title'),
        $gallery = $('<div/>', {
        id:     $id,
        class:  'gallery-show',
        html:   '<div class="close" onclick="closeGallery('+$id+');"></div><div class="content"></div>'
    });
    $gallery.attr('image', $image);
    $gallery.children('.content').append('<div class="image"><img src="'+$link+'"></div>');
    if($('.item[gallery-id="'+$id+'"]').length > 1){
        $gallery.append('<div class="controls"><div class="prev" onclick="showPrevImage();"></div><div class="next" onclick="showNextImage();"></div></div>');
    }
    if($title != undefined){
        $gallery.append('<div class="title"><span>'+$title+'</span></div>');
    }
    $('body')
        .css('overflow', 'hidden')
        .append($gallery);
}

function closeGallery(){
    $('.gallery-show').remove();
    $('body').removeAttr('style');
}

$(document).click(function(e){
    if ($(e.target).is('.gallery-show') && !$(e.target).is('.gallery-show .controls') && !$(e.target).is('.gallery-show .close')){
        closeGallery();
    }
});

function showGallery(data) {
    var $link     = data.attr('gallery-image-link'),
        $image    = data.attr('gallery-image'),
        $gallery  = $('.gallery-show');
    $gallery.attr('image', $image);
    $gallery.find('.image img').attr('src', $link);
}

function showNextImage(){
    var $id = $('.gallery-show').attr('id'),
        $image = $('.gallery-show').attr('image'),
        $item = $('body').find('[gallery-image="'+$image+'"]').next('[gallery-id="'+$id+'"]');
    if(!$item.attr('gallery-image') || $item.attr('gallery-image') == $image){
        $item = $('[gallery-id="'+$id+'"]').first();
    }
    if($item != 0 && $item.attr('gallery-image') != $image){
        showGallery($item);
    }
}

function showPrevImage(){
    var $id = $('.gallery-show').attr('id'),
        $image = $('.gallery-show').attr('image'),
        $item = $('body').find('[gallery-image="'+$image+'"]').prev('[gallery-id="'+$id+'"]');
    if(!$item.attr('gallery-image') || $item.attr('gallery-image') == $image){
        $item = $('[gallery-id="'+$id+'"]').last();
    }
    console.log($item);
    if($item.attr('gallery-image') != 0 && $item.attr('gallery-image') != $image){
        showGallery($item);
    }
}