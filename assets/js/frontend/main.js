
jQuery(document).ready(function(jQuery) {


    // hide the section is there is no blog
    if( $(".gt-blog-wrapper[data-post-type=co-workers].gt-blog-wrapper[data-has-search=false] .gt-blog-items-wrapper .row").children().length ==0 ) {
        $(".gt-blog-wrapper[data-post-type=co-workers].gt-blog-wrapper[data-has-search=false] .gt-blog-items-wrapper .row").closest('section.gt-section').addClass('d-none');
    }

    $('.gt-blog-no-posts').closest('section.gt-section').addClass('d-none');
    $('.gt-blog-no-posts').closest('section.gt-section').next('section.section-border').addClass('d-none');

// for the mob menu
    $( ".navbar-nav .submenu-opener" ).on('click', function( e ) {
        e.preventDefault();

        if ( !$( this ).hasClass( 'closed' ) ) {
            $( this ).addClass( 'closed' );
            $( this ).next('ul.dropdown-menu').css('display', 'block');
        }
        else {
            $( this ).removeClass( 'closed' );
            $( this ).next('ul.dropdown-menu').css('display', 'none');
        }

    });

    jQuery('.navbar').on('click', '.navbar-toggle-btn', function (e){
        e.preventDefault();
        if(!jQuery(this).hasClass("nav-open")) {
            jQuery('#navbar').removeClass('active');
            jQuery('body').removeClass('menu-active');
            jQuery(this).removeClass('nav-close').addClass('nav-open');
            //         jQuery('header').removeClass('nav-close').addClass('nav-open');

        } else {
            jQuery('#navbar').addClass('active');
            jQuery('body').addClass('menu-active');
            jQuery(this).removeClass('nav-open').addClass('nav-close');
        }
    });

    $(window).scroll(function(){
    var sticky = $('header'),
        scroll = $(window).scrollTop();

    if (scroll >= 30) sticky.addClass('fixed');
    else sticky.removeClass('fixed');
});

    // search form ajax request
    $('#search-employees-form').on( 'submit',function(e){
        var form = $(this);

        $('.ramberg-loading').removeClass( 'd-none' );
        $('.gt-blog-wrapper').addClass( 'pulling' );
        $.post(form.attr('action'), form.serialize(), function(response) {
            $('.gt-blog-pagination').addClass( 'd-none' );

            $('.ramberg-loading').addClass( 'd-none' );
            $('.gt-blog-wrapper').removeClass( 'pulling' );
            // console.log(data);
            $(".gt-blog-items-wrapper").html(response.data);

        }, 'json');

        return false;
    });

    // Initialize and add the map
      function initMap() {
        // The location of Uluru
        const ramberg = { lat: 59.33456165057258, lng: 18.070581511130335 };,
        // The map, centered at Uluru
        const map = new google.maps.Map(document.getElementById("map"), {
          zoom: 4,
          center: ramberg,
        });
        // The marker, positioned at Uluru
        const marker = new google.maps.Marker({
          position: ramberg,
          map: map,
        });
      }


});

function fixHeight(elem){
    var maxHeight = 0;
    $(elem).css('height','auto');
    $(elem).each(function(){
        if ($(this).height() > maxHeight) { maxHeight = $(this).height(); }
    });
    $(elem).height(maxHeight);
}

$(window).on('load resize', function(e) {
    var width = $(window).width();

    jQuery('.pricing-block').each(function () {
       var textBlock =  jQuery(this).find('.small-text-img-block').innerHeight();
       var listBlock =  jQuery(this).find('.pricing-features').innerHeight();
       var listBlockTitle =  jQuery(this).find('.pricing-features h4').innerHeight();
       var listBlockText =  jQuery(this).find('.pricing-features p').innerHeight();
       var div_padding = parseInt(jQuery(this).css('padding-bottom').replace('px',''));

       var tHeight = textBlock + div_padding;
       var ulMargin = listBlockTitle + listBlockText;

        if ( width >= 768 ) {
            jQuery(this).find('.pricing-features').css("height",'calc(100% - '+tHeight+'px)');
        }

        else {
            jQuery(this).find('.pricing-features').css("height","auto");
        }
    })

});



//# sourceMappingURL=plugins.js.map
