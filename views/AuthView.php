<?php

    if (isset($_POST['name']) && $_POST['name'] != '') {
        \Logic\AuthLogic::login($_POST['name']);
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>جامعة الرفاق</title>

    <!-- Tailwind Css -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="text-right">
<nav class="bg-green-700 text-white py-4 px-5 md:px-20 lg:px-40 text-lg font-semibold">
    محمد أبو غرارة - قسم علوم الحاسب
</nav>
<main class="px-5 md:px-20 lg:px-40 mt-5">
        <div class="alert bg-green-200 border border-green-500 text-green-700 p-3 rounded">
            ملاحظة: إذا كان المستخدم غير موجود سوف يتم إنشاء مستخدم جديد
    </div>
    <div class="flex justify-center items-center mt-20">
        <form class="w-96 p-6 bg-white rounded-lg shadow-md" method="post">
            <div class="mb-4">
                <label for="username" class="block text-gray-700 text-sm font-bold mb-2">اسم الطالب</label>
                <input type="text" id="name" name="name" class="w-full text-end px-3 py-2 border border-gray-300 rounded">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white font-bold rounded hover:bg-green-700">تسجيل</button>
            </div>
        </form>
    </div>
</main>
</body>
</html>