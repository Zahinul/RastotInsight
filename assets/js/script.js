$(document).ready(function () {
    $(".menu-toggle").on("click", function () {
      $(".nav").toggleClass("showing");
    });
  
    $(".post-wrapper").slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 2000,
      prevArrow: $(".prev"),
      nextArrow: $(".next"),
      responsive: [
        {
          breakpoint: 1000,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2,
          },
        },
        {
          breakpoint: 700,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
        // You can unslick at a given breakpoint now by adding:
        // settings: "unslick"
        // instead of a settings object
      ],
    });
  });
  /*var quill = new Quill("#editor", {
    theme: "snow",
  });*/
  CKEDITOR.replace('core');
  CKEDITOR.replace('description');

  
  /*DecoupledEditor
  .create( document.querySelector( '#editor' ) )
  .then( editor => {
      const toolbarContainer = document.querySelector( '#toolbar-container' );

      toolbarContainer.appendChild( editor.ui.view.toolbar.element );
  } )
  .catch( error => {
      console.error( error );
  } );*/
  