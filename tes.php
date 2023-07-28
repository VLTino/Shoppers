<form action="shop.php" method="post">
  <input type="text" name="search" class="form-control" placeholder="Search for products...">
</form>
<script>
  $(document).ready(function() {
    // Tangkap nilai pencarian saat form dikirimkan
    $('#searchInput').on('input', function() {
      var searchTerm = $(this).val();

      // Kirim permintaan filter ke server menggunakan AJAX
      $.ajax({
        url: 'filter.php', // Ganti dengan URL endpoint untuk pemrosesan filter di sisi server
        type: 'POST',
        data: { search: searchTerm },
        beforeSend: function() {
          // Tampilkan loader atau animasi loading jika diperlukan
        },
        success: function(response) {
          // Update daftar produk dengan hasil filter dari server
          $('#productList').html(response);
          // Perbarui URL dengan kata kunci pencarian
          var newUrl = 'shop.php?search=' + encodeURIComponent(searchTerm);
          window.history.pushState({ path: newUrl }, '', newUrl);
        }
      });
    });
  });
</script>
