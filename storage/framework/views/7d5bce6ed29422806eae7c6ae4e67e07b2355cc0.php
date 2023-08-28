<div id="gotoTop" class="icon-angle-up"></div>



<script src="https://kit.fontawesome.com/10af5283a9.js" crossorigin="anonymous"></script>
<script src="<?php echo e(asset('themes/frontend/biasg/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('themes/frontend/biasg/js/jquery.js')); ?>"></script>
<script async src="<?php echo e(asset('themes/frontend/biasg/js/style.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  const swiper = new Swiper('.swiper', {
    loop: true,
    autoplay: {
      delay: 5000,
    },
    pagination: {
      el: '.swiper-pagination',
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  });
  const swiper_tab = new Swiper('.swiper-tab', {
    loop: true,
    slidesPerView: 3,
    spaceBetween: "10px",
    autoplay: {
      delay: 4000,
    }
  });
  // Form ajax default
  $(".form_ajax").submit(function(e) {
      e.preventDefault();
      var form = $(this);
      var url = form.attr('action');
      $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(),
        success: function(response) {
          form[0].reset();
          alert(response.message);
          location.reload();
        },
        error: function(response) {
          // Get errors
          console.log(response);
          var errors = response.responseJSON.errors;
          // Foreach and show errors to html
          var elementErrors = '';
          $.each(errors, function(index, item) {
            if (item === 'CSRF token mismatch.') {
              item = "<?php echo app('translator')->get('CSRF token mismatch.'); ?>";
            }
            elementErrors += '<p>' + item + '</p>';
          });
        }
      });
    });
    const swiper_cer = new Swiper('.swiper_cer', {
      loop: true,
      autoplay: {
        delay: 4000,
      },
      breakpoints: {
        320: {
          slidesPerView: 1,
          spaceBetween: 30
        },
        480: {
          slidesPerView: 1,
          spaceBetween: 30
        },
        786: {
          slidesPerView: 3,
          spaceBetween: 90
        },
      },
      pagination: {
        el: '.swiper-pagination',
      },

      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      }

    });
    $(document).on('click','.nav-link', function(){
      let id = $(this).data('id');
      $('.nav-link').removeClass('active');
      $(this).addClass('active');

      $('.detail-list').removeClass('active');
      $('#'+id).addClass('active');
      // $('.tab-content').slick('setPosition');
    })
    $(document).on('click','.link-scroll', function(){
      let id = $(this).data('id');
      $('.link-scroll').removeClass('active');
      $(this).addClass('active');
    })
    $(document).on('click', '.icon-search', function() {
      var formSearch = $('.form-search');
      
      if (formSearch.hasClass('active')) {
        formSearch.removeClass('active');
      } else {
        formSearch.addClass('active');
      }
    });
    $("#header .search-button .icon").click(function() {
      if($("#header .search-button").hasClass("active")) {
        $("#header .search-button").removeClass("active")
      } else {
        $("#header .search-button").addClass("active")
      }
    })
</script>
 
<?php if(isset($web_information->source_code->footer)): ?>
<?php echo $web_information->source_code->footer; ?>

<?php endif; ?><?php /**PATH C:\xampp\htdocs\biasg\resources\views/frontend/panels/scripts.blade.php ENDPATH**/ ?>