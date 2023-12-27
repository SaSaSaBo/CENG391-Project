<?php
include "connection.php";

// Gelen ID parametresini al
if (isset($_GET['id'])) {
    $id_to_delete = $_GET['id'];

    // Güvenli bir şekilde parametreyi kullanarak sorgu oluşturma
    $stmt = $connection->prepare("DELETE FROM course WHERE CourseID = ?");
    $stmt->bind_param("s", $id_to_delete);

    // Sorguyu çalıştır
    if ($stmt->execute()) {
        echo "<script>alert('Course successfully deleted.');</script>";
        header("Location: tables.php"); // Ana sayfaya yönlendirme
        exit();
    } else {
        // Hata detaylarını ekrana yazdır
        echo "Hata: " . $stmt->error . "<br>";
        echo "<script>alert('Error deleting course.');</script>";
        header("Location: tables.php"); // Hata durumunda ana sayfaya yönlendirme
        exit();
    }
} else {
    // Hatalı istek durumu
    echo "Hatalı istek";
}

// Bağlantıyı kapat
$stmt->close();
$connection->close();
?>
