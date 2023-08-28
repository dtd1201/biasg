<div id="gotoTop" class="icon-angle-up"></div>



<script src="https://kit.fontawesome.com/10af5283a9.js" crossorigin="anonymous"></script>
<script src="<?php echo e(asset('themes/frontend/honey/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('themes/frontend/honey/js/jquery.js')); ?>"></script>
<script async src="<?php echo e(asset('themes/frontend/honey/js/style.js')); ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>

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
</script>
 
<?php if(isset($web_information->source_code->footer)): ?>
<?php echo $web_information->source_code->footer; ?>

<?php endif; ?><?php /**PATH C:\xampp\htdocs\honey\resources\views/frontend/panels/scripts.blade.php ENDPATH**/ ?>