$(function(){
    $('.btn.delete').click(function(e){
        e.preventDefault();
        var item_id = $(this).attr('item_id');
        var el = $(this).parent().parent().parent().parent();
        $.ajax({
            url:include_path+'/ajax/delete.php',
            data:{id:item_id},
            method:'post'
        }).done(function(){
            el.fadeOut();
        })

       
    })
})