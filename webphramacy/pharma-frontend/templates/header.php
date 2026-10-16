<?php
declare(strict_types=1);
$templateTitle = $templateTitle ?? 'PharmaCare';
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($templateTitle, ENT_QUOTES, 'UTF-8') ?> | PharmaCare</title>
    <link rel="stylesheet" href="assets/css/tailwind.output.css">
</head>
<body class="min-h-screen bg-slate-50 text-slate-800">
<div class="flex min-h-screen">
