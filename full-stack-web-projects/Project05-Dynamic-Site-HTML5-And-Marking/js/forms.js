$(function(){
	

	$('body').on('submit','form.ajax-form',function(){
		var form = $(this);
		$.ajax({
			beforeSend:function(){
				$('.overlay-loading').fadeIn();
			},
			url:include_path+'ajax/forms.php',
			method:'post',
			dataType: 'json',
			data:form.serialize()
		}).done(function(data){
			if(data.success){
				//All right, let's improve the interface!
				$('.overlay-loading').fadeOut();
				$('.success').slideToggle();
				setTimeout(function(){
					$('.success').fadeOut();
				},3000)
			}else{
				//Something it is wrong.
				$('.overlay-loading').fadeOut();
			}
		});
		return false;
	})

})
