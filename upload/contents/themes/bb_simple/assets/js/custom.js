function user_home_avatar(fullname,avatar_img)
{
    var li='';

    if(avatar_img==null)
    {
        avatar_img='';
    }

    if(avatar_img.length < 5)
    {
        li='<span class="avartar-dymamic avartar-dymamic-'+fullname[0].toLowerCase()+'" style="">'+fullname[0].toUpperCase()+'</span>';
    }
    else
    {
        li='<img src="'+SITE_URL+avatar_img+'" class="card-img-top" alt="'+fullname+'">';
    }


    return li;
}



$("#goToTop").click(function() {
    $("html, body").animate({scrollTop: 0}, 1000);
 });



$(document).on('click','.bb_show_notifies',function(){
    $('#modalNotifies').modal('show');
});