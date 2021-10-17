/*
 * Main JavaScript
 *
 *
 */

function O(i) { 
    return typeof i == 'object' ? i : document.getElementById(i);
}

function S(i) { 
    return O(i).style
}

function C(i) { 
    return document.getElementsByClassName(i)
}

// console.log('LAMP Main');



window.addEventListener('DOMContentLoaded', function() {

    let go_to_member_page = true;
    let toastCon = document.getElementById('toastCon');
    let toastTMPL = document.getElementById('toastTemplate');

    $('img.header-img', toastTMPL).each(function() {
        $(this).attr('src', FAVICON_URL);
    });

    $('strong.header-txt', toastTMPL).each(function() {
        $(this).html(SITE_NAME);
        console.log(this);
    });

    // console.log(FAVICON_URL);


    let makeToast = function(msg) {
        var cln = toastTMPL.cloneNode(true);
        $(cln).attr('id', null);
        $('.toast-body', cln).html(msg);
        $(toastCon).append(cln);
        var toast = new bootstrap.Toast(cln);
        toast.show();
        setTimeout(function(){ 
            toast.dispose();
            $(cln).remove(); 
        }, 9000);
    };

    // friends list items
    $('.list-group-item.list-group-item-action', '.friends-list').each(function(){
        let attr = $(this).attr('data-link-href');
        // For some browsers, `attr` is undefined; for others,
        // `attr` is false.  Check for both.
        if (typeof attr !== 'undefined' && attr !== false) {
            $(this).on('click', function() {
                if(!go_to_member_page) {
                    go_to_member_page = true;
                    return;
                }
                let attr = $(this).attr('data-link-href');
                window.location.assign(attr);
            });
        }
    });


    // follow members links
    $('a.follow-member-link', '.follow-members-btns').each(function() {
        $(this).on('click', function(e) {
            
            e.preventDefault();
            go_to_member_page = false;

            let href_attr = $(this).attr('href');

            let other_btn_class = ($(this).hasClass('follow')) ? '.un-follow' : '.follow';
            let other_btn = $(other_btn_class, $(this).parent());
            let current_btn = this;

            $.ajax({
                url: href_attr,
                success: function(data, textStatus, jqXHR) {
                    $(other_btn).removeClass('visually-hidden');
                    $(current_btn).addClass('visually-hidden');
                    makeToast(data.message);
                    console.log(data);
                }
            });
        });
    });

    $("#sendMessageForm").each(function() {
        $('#flexSwitchCheckDefault', this).each(function(){
            $(this).on('click', function(){
                var value = ($(this).val() == 'y') ? 'n' : 'y';
                $(this).val(value);
            });
        });
    });
});


