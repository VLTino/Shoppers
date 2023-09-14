<?php
// Inisialisasi tanggal awal dan akhir dengan nilai default atau nilai dari input
// Hitung tanggal 7 hari sebelum sekarang
$defaultStartDate = date('Y-m-d', strtotime('-7 days'));
$defaultEndDate = date('Y-m-d');

// Set tanggal awal dan akhir dengan nilai default
$startDate = isset($_POST['start_date']) ? $_POST['start_date'] : $defaultStartDate;
$endDate = isset($_POST['end_date']) ? $_POST['end_date'] : $defaultEndDate;


// Ubah format tanggal sesuai dengan format yang diinginkan (YYYY-MM-DD)
$startDate = date('Y-m-d', strtotime($startDate));
$endDate = date('Y-m-d', strtotime($endDate));

// Buat koneksi ke database

// Koneksi ke database Anda
$koneksi = mysqli_connect("localhost", "root", "", "onlineshop");

// Periksa koneksi
if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data penjualan per hari dalam rentang tanggal yang diinginkan
// ...
// Query untuk mengambil data penjualan per hari dalam rentang tanggal yang diinginkan
$query = "SELECT DATE(order_date) AS tanggal, COUNT(*) AS jumlah_pesanan, SUM(orders_total) AS total_uang 
          FROM orders 
          WHERE status NOT IN ('unpaid', 'expired') 
          AND DATE(order_date) BETWEEN '$startDate' AND '$endDate'
          GROUP BY DATE(order_date)";

$result = mysqli_query($koneksi, $query);

// Buat array asosiatif untuk menyimpan jumlah pesanan per hari
// Buat array asosiatif untuk menyimpan jumlah pesanan, total uang, dan tanggal
$data = array();

// Inisialisasi tanggal awal dan akhir
$currentDate = new DateTime($startDate);
$endDateObj = new DateTime($endDate);

while ($currentDate <= $endDateObj) {
    $tanggal = $currentDate->format('Y-m-d');
    
    // Inisialisasi jumlah pesanan dan total uang menjadi 0
    $jumlah_pesanan = 0;
    $total_uang = 0;
    
    // Cek apakah tanggal ini ada dalam hasil query
    foreach ($result as $row) {
        if ($row['tanggal'] == $tanggal) {
            $jumlah_pesanan = $row['jumlah_pesanan'];
            $total_uang = $row['total_uang'];
            break;
        }
    }
    
    // Tambahkan tanggal, jumlah pesanan, dan total uang ke dalam array data
    $data[] = array('tanggal' => $tanggal, 'jumlah_pesanan' => $jumlah_pesanan, 'total_uang' => $total_uang);
    
    // Tambahkan 1 hari ke tanggal awal
    $currentDate->modify('+1 day');
}

// Hitung total pesanan dan total uang dari hasil query
$totalPesanan = array_sum(array_column($data, 'jumlah_pesanan'));
$totalUang = array_sum(array_column($data, 'total_uang'));

// Tutup koneksi database
mysqli_close($koneksi);

// Ubah data menjadi format JSON
$json_data = json_encode($data);

// ...

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Sisipkan skrip Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Form untuk memilih tanggal awal dan akhir -->
    <form method="POST" action="">
        <label for="start_date">Tanggal Awal:</label>
        <input type="date" id="start_date" name="start_date" value="<?php echo $startDate; ?>">

        <label for="end_date">Tanggal Akhir:</label>
        <input type="date" id="end_date" name="end_date" value="<?php echo $endDate; ?>">

        <input type="submit" value="Tampilkan Grafik">
    </form>
    <div>
    <?php
    // Format total uang ke dalam Rupiah
    $formattedTotalUang = number_format($totalUang, 0, ',', '.'); // 0 desimal, koma sebagai pemisah ribuan, titik sebagai pemisah desimal

    // Tampilkan total pesanan dan total uang dalam format Rupiah
    echo '<h2>Total Pesanan: ' . $totalPesanan . '</h2>';
    echo '<h2>Total Uang: Rp ' . $formattedTotalUang . '</h2>';
    ?>

</div>
    <!-- Buat elemen untuk grafik -->
    <canvas id="myChart"></canvas>

    <script>
        // Ambil data dari PHP dan ubah menjadi variabel JavaScript
        // Ambil data dari PHP dan ubah format tanggal menjadi "dd/mm/yyyy"
var salesData = <?php echo json_encode(array_map(function($row) {
    return [
        'tanggal' => date('d/m/y', strtotime($row['tanggal'])),
        'jumlah_pesanan' => $row['jumlah_pesanan']
    ];
}, $data)); ?>;


        // Siapkan label tanggal dan jumlah pesanan
        var labels = [];
        var totalSales = [];

        for (var i = 0; i < salesData.length; i++) {
            labels.push(salesData[i].tanggal);
            totalSales.push(salesData[i].jumlah_pesanan);
        }

        // Buat grafik
// Temukan jumlah pesanan terbanyak
var maxPesanan = Math.max.apply(Math, totalSales);

// Menambahkan 5 untuk memberikan ruang kosong di bagian atas grafik
var suggestedMax = maxPesanan + 6;

// Buat grafik
var ctx = document.getElementById('myChart').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line', // Jenis grafik (line chart)
    data: {
        labels: labels, // Label sumbu X (tanggal)
        datasets: [{
            label: 'Jumlah Pesanan',
            data: totalSales, // Data jumlah pesanan
            backgroundColor: '#4e73df', // Warna area grafik
            borderColor: '#4e73df', // Warna garis grafik
            borderWidth: 3 // Lebar garis grafik
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true,
                suggestedMax: suggestedMax, // Mengatur nilai maksimum sesuai dengan jumlah pesanan terbanyak
                precision: 0, // Mengatur angka desimal pada label sumbu Y menjadi 0
                stepSize: 1 // Mengatur interval langkah sumbu Y menjadi 1
            }
        }
    }
});


    </script>
</body>
</html>
