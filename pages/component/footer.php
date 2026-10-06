<!-- 1. jQuery (Wajib paling atas) -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<!-- 2. Popper.js (Dibutuhkan oleh Bootstrap 4) -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- 3. Bootstrap 4 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

<!-- 4. Script Inisialisasi Carousel (Opsional tapi direkomendasikan) -->
<script>
  $(document).ready(function(){
    $('#heroCarousel').carousel({
      interval: 5000,
      pause: 'hover'
    });
  });
</script>