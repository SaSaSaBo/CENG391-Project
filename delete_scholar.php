<?php
include "connection.php";

// Gelen ID parametresini al
if (isset($_GET['id'])) {
    $id_to_delete = $_GET['id'];

    // Güvenli bir şekilde parametreyi kullanarak sorgu oluşturma
    $stmt = $connection->prepare("DELETE FROM scholar WHERE StudentID = ?");
    $stmt->bind_param("s", $id_to_delete);

    // Sorguyu çalıştır
    if ($stmt->execute()) {
        echo "<script>alert('Scholarship informations successfully deleted.');</script>";
        header("Location: tables.php"); // Ana sayfaya yönlendirme
        exit();
    } else {
        // Hata detaylarını ekrana yazdır
        echo "Hata: " . $stmt->error . "<br>";
        echo "<script>alert('Error deleting scholarship informations.');</script>";
        header("Location: tables.php"); // Hata durumunda ana sayfaya yönlendirme
        exit();
    }
} else {
    // Hatalı istek durumu
    echo "Invalid request";
}

// Bağlantıyı kapat
$stmt->close();
$connection->close();
?>
