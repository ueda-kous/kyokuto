$(function(){
	$('#post01').jpostal({
		postcode : [
			'#post01',
			'#post02'
		],
		address : {
			'#pref'  : '%3',
			'#address01'  : '%4%5'
		}
	});

});


$(function(){
	var errors = $('.text-danger').length;
	if(errors>0){
		var position = $('.text-danger').eq(0).parents('td').offset().top;
		 $('body,html').stop().animate({ scrollTop: position }, 800, 'swing');
	}
});


$(function(){
	$.fn.autoKana('#namae', '#kana', {
        katakana : true  //true：カタカナ、false：ひらがな（デフォルト）
    });
});