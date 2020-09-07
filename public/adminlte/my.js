$('.delete').click(function(){
    var res = confirm('Подтвердите действие');
    if(!res) return false;
});
$(".sidebar-menu a").each(function () {
    let location  = window.location.protocol + "//" + window.location.host + window.location.pathname;
    let href = this.href;
    if(href == location){
        $(this).parent().addClass('active');
        $(this).closest('.treeview').addClass('active');

    }


});