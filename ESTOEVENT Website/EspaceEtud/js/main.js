const responsive = {
    0: {
        items: 1
    },
    320: {
        items: 1
    },
    560: {
        items: 2
    },
    960: {
        items: 3
    }
}


$(document).ready(function () {

    $nav = $('.nav');
    $toggleCollapse = $('.toggle-collapse');

    /** click event on toggle menu */
    $toggleCollapse.click(function () {
        $nav.toggleClass('collapse');
    })

    // owl-crousel for blog
    $('.owl-carousel').owlCarousel({
        loop: true,
        autoplay: false,
        autoplayTimeout: 3000,
        dots: false,
        nav: true,
        navText: [$('.owl-navigation .owl-nav-prev'), $('.owl-navigation .owl-nav-next')],
        responsive: responsive
    });


    // click to scroll top
    $('.move-up span').click(function () {
        $('html, body').animate({
            scrollTop: 0
        }, 1000);
    })

    // AOS Instance
    AOS.init();

});


owl.on('mousewheel', '.owl-stage', function (e) {
    if (e.deltaY>0) {
        owl.trigger('next.owl');
    } else {
        owl.trigger('prev.owl');
    }
    e.preventDefault();
});

function openSlideMenu(){
    document.getElementById('menu').style.width = '250px';
    document.getElementById('content').style.marginLeft = '250px';
    document.querySelector('.burgerMenu').style.visibility='hidden';
    
  }
  function closeSlideMenu(){
    document.getElementById('menu').style.width = '0';
    document.getElementById('content').style.marginLeft = '0';
    document.querySelector('.burgerMenu').style.visibility='visible';
}
  function logoutModal(){
     Swal.fire({
        title: 'Vous êtes sure de vous déconnecter ?',
        icon: 'warning',
        showCancelButton: true,
        cancelButtonText: 'Annuler',   
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Confirmer'
      }).then((result) => {
        if (result.value) {
          window.location.href = "logout.php";
        }
      })
    }  
function EditProfil(){
        document.querySelector("#modal").style.display="flex";
        closeSlideMenu();
}
function CloseModal(){
    document.querySelector("#modal").style.transition=".4s";
    document.querySelector("#modal").style.display="none";
}