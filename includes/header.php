<?php
// Tentukan path ke root secara dinamis untuk browser (CSS, Images, Links)
$current_path = $_SERVER['PHP_SELF'];
$path_to_root = "";

// Jika berada di dalam folder 'pages', naik 2 level
if (strpos($current_path, '/pages/') !== false) {
    $path_to_root = "../../";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Typify - Writing Ecosystem</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- CSS Files -->
    <link rel="stylesheet" href="<?php echo $path_to_root; ?>css/layout.css">
    <link rel="stylesheet" href="<?php echo $path_to_root; ?>css/components.css">
    <link rel="stylesheet" href="<?php echo $path_to_root; ?>css/animations.css">
    <link rel="stylesheet" href="<?php echo $path_to_root; ?>css/responsive.css">
</head>
<body>
