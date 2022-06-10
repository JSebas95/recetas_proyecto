require('./bootstrap');

import 'owl.carousel';

/* Carousel */
jQuery(document).ready(function(){
  jQuery('.owl-carousel').owlCarousel({
    margin:10,
    loop:true,
    autoplay:true,
    autoplayHoverPause:true
    //items:3,
    /*responsive: {
      0 : { // de 0 - 599 muestra un item
        items : 1
      },
      600 : { // 600-999 muestra 2 items
        items : 2
      },
      1000 : {
        items: 3
      }
    }*/
  })
});