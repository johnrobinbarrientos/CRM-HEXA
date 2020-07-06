$(document).ready(function(){
    $(document).on('click','.nk-menu-item.has-sub',function(){
        var link = $(this)
        if (!link.hasClass('active')) {
            link.addClass('active')
            link.find('.nk-menu-sub').css({ 'display' : 'block' });
        } else {
            link.removeClass('active')
            link.find('.nk-menu-sub').css({ 'display' : 'none' });
        }
    });
});