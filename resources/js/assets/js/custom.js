$(document).ready(function(){
    $(document).on('click','.nk-menu-item.has-sub > .nk-menu-link',function(){
        var link = $(this)
        if (!link.closest('.nk-menu-item').hasClass('active')) {
            link.closest('.nk-menu-item').addClass('active')
            link.closest('.nk-menu-item').find('.nk-menu-sub').css({ 'display' : 'block' });
        } else {
            link.closest('.nk-menu-item').removeClass('active')
            link.closest('.nk-menu-item').find('.nk-menu-sub').css({ 'display' : 'none' });
        }
    });
});