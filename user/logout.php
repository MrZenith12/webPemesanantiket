<?php
session_start();

// menghapus data session
session_unset();
session_destroy();

// mengalihkan pengguna ke halaman login
header("Location: ../beranda.php");
exit;
?>
