<?php
// Buat koneksi ke database

// Koneksi ke database Anda
$koneksi = mysqli_connect("localhost", "root", "", "onlineshop");

// Periksa koneksi
if (mysqli_connect_error()) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data penjualan
$query = "SELECT DATE_FORMAT(order_date, '%M %Y') AS bulan, COUNT(*) AS jumlah_pesanan 
          FROM orders 
          WHERE status NOT IN ('unpaid', 'expired') 
          GROUP BY DATE_FORMAT(order_date, '%M %Y')";

$result = mysqli_query($koneksi, $query);

// Buat array asosiatif untuk menyimpan jumlah pesanan per bulan
$data = array();

// Inisialisasi tanggal awal dan akhir yang Anda inginkan
$startDate = new DateTime('2023-01-01'); // Ganti dengan tanggal awal yang sesuai
$endDate = new DateTime('2023-12-31');   // Ganti dengan tanggal akhir yang sesuai

// Buat rentang bulan dari tanggal awal hingga tanggal akhir
while ($startDate <= $endDate) {
    $bulan = $startDate->format('F Y');
    
    // Inisialisasi jumlah pesanan menjadi 0
    $jumlah_pesanan = 0;
    
    // Cek apakah bulan ini ada dalam hasil query
    foreach ($result as $row) {
        if ($row['bulan'] == $bulan) {
            $jumlah_pesanan = $row['jumlah_pesanan'];
            break;
        }
    }
    
    // Tambahkan bulan dan jumlah pesanan ke dalam array data
    $data[] = array('bulan' => $bulan, 'jumlah_pesanan' => $jumlah_pesanan);
    
    // Tambahkan 1 bulan ke tanggal awal
    $startDate->modify('+1 month');
}

// Tutup koneksi database
mysqli_close($koneksi);

// Ubah data menjadi format JSON
$json_data = json_encode($data);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Sisipkan skrip Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <!-- Buat elemen untuk grafik -->
    <div class="ff" style="width:80%">
    <canvas id="myChart"></canvas>
    </div>

    <script>
        // Ambil data dari PHP dan ubah menjadi variabel JavaScript
        var salesData = <?php echo $json_data; ?>;

        // Siapkan label bulan dan jumlah pesanan
        var labels = [];
        var totalSales = [];

        for (var i = 0; i < salesData.length; i++) {
            labels.push(salesData[i].bulan);
            totalSales.push(salesData[i].jumlah_pesanan);
        }

        // Buat grafik
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line', // Jenis grafik (line chart)
            data: {
                labels: labels, // Label sumbu X (bulan)
                datasets: [{
                    label: 'Jumlah Pesanan',
                    data: totalSales, // Data jumlah pesanan
                    backgroundColor: 'rgba(75, 192, 192, 0.2)', // Warna area grafik
                    borderColor: 'rgba(75, 192, 192, 1)', // Warna garis grafik
                    borderWidth: 1 // Lebar garis grafik
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
