<?php

if (strlen(session_id()) < 1)
    session_start();
?>

<!doctype html>
<html lang="es">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css">

    <!-- DATATABLES -->
    <link rel="stylesheet" href="../public/DataTables/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="../public/DataTables/css/datatables.min.css">
    <link rel="stylesheet" href="../public/DataTables/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="../public/DataTables/css/buttons.bootstrap.min.css">
    <link rel="stylesheet" href="../public/DataTables/css/select.dataTables.min.css">
    <link rel="stylesheet" href="../public/DataTables/css/colReorder.dataTables.min.css">
    <link rel="stylesheet" href="../public/DataTables/css/scroller.dataTables.min.css">
    <link rel="stylesheet" href="../public/DataTables/css/rowReorder.dataTables.min.css">
    <link rel="stylesheet" href="../public/DataTables/css/editor.dataTables.min.css">
    <link rel="stylesheet" href="../public/DataTables/css/fixedColumns.dataTables.min.css">


    <!-- Bootstrap Select -->
    <!-- <link rel="stylesheet" href="../public/css/bootstrap-select.min.css"> -->
    <link rel="stylesheet" href="../public/css/bootstrap-select.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="../public/css/font-awesome.min.css">

    <!-- My Styles -->
    <link rel="stylesheet" href="../public/css/styles.css">

    <title>SICOAIN - Sistema de Control de Accidentes e Incidentes</title>
</head>

<body>
    <div class="container-fluid main-box">
        <div class="title-page fixed-top">
            <div class="container-fluid">
                <div class="logo-box ml-2 ml-sm-5">
                    <img src="../public/images/logo1.png" title="SICOAIN">
                </div>
                <!-- <h1 class="d-inline">SICOAIN - Sistema de Control de Accidentes e Incidentes</h1> -->
                <p class="float-right mr-2 mr-sm-5">Usuario: <?php echo $_SESSION['nombre']; ?></p>
            </div>
        </div>
        <div class="posicionador"></div>