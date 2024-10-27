<?php
// เชื่อมต่อกับฐานข้อมูล
$connect = mysqli_connect('db', 'php_docker', 'password', 'php_docker');

// รับ ID ของหนังสือจากพารามิเตอร์ URL
$book_id = $_GET['id'];

// คิวรีเพื่อดึงข้อมูลหนังสือ
$query = "SELECT * FROM books WHERE id = ?";
$stmt = mysqli_prepare($connect, $query);
mysqli_stmt_bind_param($stmt, 's', $book_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$book = mysqli_fetch_assoc($result);

// แสดงรายละเอียดหนังสือ
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <title><?php echo $book['title']; ?></title>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <div class="max-w-2xl mx-auto px-4 py-12">
        <h1 class="text-3xl font-bold"><?php echo $book['title']; ?></h1>
        <p class="mt-4 text-lg">Author: <?php echo $book['author']; ?></p>
        <p class="mt-2">Category: <?php echo $book['category_id']; ?></p>
        <img src="<?php echo $book['image_url']; ?>" alt="<?php echo $book['title']; ?>" class="mt-4 rounded-md">
        <p class="mt-4"><?php echo $book['description']; ?></p>
    </div>
</body>

</html>