$(function() {
    let f = $('#faq #main .wrap1 dl.list1 dt');
    let q = $('#faq #main .wrap1 dl.list1 dd');
    $(document).on('click','#faq #main .wrap1 dl.list1 dt',function(){
        if($(this).hasClass('on')){
            $(this).next('dd').stop().slideUp('slow');
            $(this).removeClass('on');
        }else{
            $(this).next('dd').stop().slideDown('slow');
            $(this).addClass('on');
        }
    });
});