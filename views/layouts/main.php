<?php

if (class_exists('yii\debug\Module')) {
    $this->off(\yii\web\View::EVENT_END_BODY, [\yii\debug\Module::getInstance(), 'renderToolbar']);
}

/* @var $this \yii\web\View */

/* @var $content string */

// use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use aryelds\sweetalert\SweetAlert;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script>
        const baseUrl = '<?= Yii::$app->request->baseUrl ?>';
    </script>
</head>

<body class="hold-transition sidebar-mini sidebar-collapse layout-fixed layout-navbar-fixed" style="font-size:0.8em">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <h5 class="mt-2" style="color:green">DATA MASTER RSUD AA</h5>
            </ul>

            <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <!-- Messages Dropdown Menu -->
                <li class="nav-item dropdown user user-menu">
                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                        <img src="<?= Yii::$app->request->baseUrl ?>/images/rsudaa.png" class="user-image img-circle elevation-2" alt=" User Image">
                        <span class="hidden-xs"><?php // Yii::$app->user->identity->username 
                                                ?></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <!-- User image -->
                        <li class="user-header bg-primary">
                            <img src="<?= Yii::$app->request->baseUrl ?>/images/rsudaa.png" class="img-circle elevation-2" alt="User Image">

                            <p>
                                <h8><?= Yii::$app->user->identity->nama; ?> - <?= Yii::$app->user->identity->roles; ?></h8>
                                <!-- <small>Member since Nov. 2012</small> -->
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-6 text-left">
                                    <!-- <a href="#" class="btn btn-default btn-flat">Profile</a> -->
                                </div>
                                <div class="col-6 text-right ">
                                    <a href="<?= Yii::$app->urlManager->createUrl('keluar') ?>" class="btn btn-default btn-flat">Sign out</a>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->

                    </ul>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="<?= Yii::$app->urlManager->createUrl('site/index') ?>" class="brand-link">
                <img src="<?= Yii::$app->request->baseUrl ?>/images/rsudaa.png" alt="RSUD LOGO" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><?= Yii::$app->params['name-aplikasi'] ?></span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('site/index') ?>" class="nav-link">
                                <i class="nav-icon far fa fa-home"></i>
                                <p>Home</p>
                            </a>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Master SDM
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/negara') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Kewarganegaraan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/provinsi') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Provinsi</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/kabupaten') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Kabupaten</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/kecamatan') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Kecamatan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/kelurahan') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Kelurahan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/suku') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Suku</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/pegawai') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Pegawai</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/pegawai-hari-libur') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Hari Libur</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/pegawai-agama') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Agama</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/pegawai-unit-penempatan') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Unit Penempatan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/pegawai-unit-sub-penempatan') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Jabatan Penempatan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/pegawai-pendidikan-umum') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Pendidikan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/pegawai-jurusan') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Jurusan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/pegawai-status-kepegawaian') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Status Kepegawaian</p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Type User</p>
                                    </a>
                                </li> -->
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa fa-file"></i>
                                <p>
                                    Master Pendaftaran
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/pendaftaran-cara-keluar') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Cara Keluar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/pendaftaran-status-keluar') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Status Keluar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/pendaftaran-kelompok-unit-layanan') ?>" class="nav-link">
                                    <i class="nav-icon far fa-circle"></i>
                                    <p>Kelompok Unit Layanan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/pendaftaran-kelas-rawat') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Kelas Rawat</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/pendaftaran-debitur') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Debitur</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/pendaftaran-debitur-detail') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Debitur Detail</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/pendaftaran-kiriman') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Kiriman</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/pendaftaran-kiriman-detail') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Kiriman Detail</p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/pendaftaran-loket') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Loket</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/pendaftaran-loket-unit') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Loket Unit</p>
                                    </a>
                                </li> -->
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/pendaftaran-cara-masuk-unit') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Cara Masuk Unit</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa fa-cash-register"></i>
                                <p>
                                    Master Kasbank
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/kasbank-loket') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Loket</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-notes-medical"></i>
                                <p>
                                    Master MEDIS
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/medis-tindakan') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Tindakan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/medis-sk-tarif') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>SK Tarif</p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/medis-tarif-tindakan') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Tarif Tindakan</p>
                                    </a>
                                </li> -->
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/medis-tarif-tindakan-unit') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Tarif Tindakan Unit</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/medis-kamar') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Kamar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/medis-tarif-kamar') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Tarif Kamar</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/medis-masalah-keperawatan') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Masalah Keperawatan</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/medis-intervensi-keperawatan') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Intervensi Keperawatan</p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/medis-icd9cm') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>ICD 9 CM</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/medis-icd10cm') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>ICD 10 CM</p>
                                    </a>
                                </li> -->
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/medis-icd9cm2010') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>ICD 9 CM 2010</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/medis-icd10cm2010') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>ICD 10 CM 2010</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/medis-anatomi') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Anatomi</p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/bpjs-poli') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Poli BPJS</p>
                                    </a>
                                </li> -->
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/bpjskes-mapping-poli-new') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Mapping Poli BPJS</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-cube"></i>
                                <p>
                                    Data Paket MCU
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/mcu-paket') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Paket MCU</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/mcu-paket-tindakan-mcu') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Paket Tindakan MCU</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/mcu-dokter-paket-tindakan-mcu') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Dokter Paket Tindakan MCU</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- <li class="nav-item">
                            <a href="<?= Yii::$app->urlManager->createUrl('/tind-kel/mapping-kode-jenis') ?>" class="nav-link">
                                <i class="nav-icon far fa fa-chart-pie"></i>
                                <p>Mapping Kode Jenis Tindakan</p>
                            </a>
                        </li> -->

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa fa-hospital"></i>
                                <p>
                                    Master Rumah Sakit
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/master-data-dasar-rs') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Data Rumah Sakit</p>
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/komputer-rs') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Komputer Rumah Sakit</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa fa-users"></i>
                                <p>
                                    Manajemen User
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= Yii::$app->urlManager->createUrl('/aplikasi') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Aplikasi</p>
                                    </a>
                                    <a href="<?= Yii::$app->urlManager->createUrl('/user') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Pengguna</p>
                                    </a>
                                    <a href="<?= Yii::$app->urlManager->createUrl('/akses-unit') ?>" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>Akses Unit Pengguna</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        
                       

                        <!-- <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                <i class="nav-icon far fa fa-th"></i>
                <p>
                    Data Tindakan Kelas
                    <i class="fas fa-angle-left right"></i>
                </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= Yii::$app->urlManager->createUrl('/tind-kel') ?>" class="nav-link">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Tindakan Kelas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= Yii::$app->urlManager->createUrl('/tind-kelas') ?>" class="nav-link">
                        <i class="nav-icon far fa-circle"></i>
                        <p>Tindakan Kelas Detail</p>
                    </a>
                </li>
                </ul>
            </li> -->

                        <!-- <li class="nav-item">
                <a href="<?= Yii::$app->urlManager->createUrl('/master-cara-keluar') ?>" class="nav-link">
                    <i class="nav-icon far fa fa-chart-pie"></i>
                    <p>Cara Keluar</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?= Yii::$app->urlManager->createUrl('/master-cara-masuk-unit') ?>" class="nav-link">
                    <i class="nav-icon far fa fa-chart-pie"></i>
                    <p>Cara Masuk Unit</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?= Yii::$app->urlManager->createUrl('/master-jenis-identitas') ?>" class="nav-link">
                    <i class="nav-icon far fa fa-chart-pie"></i>
                    <p>Jenis Identitas</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?= Yii::$app->urlManager->createUrl('/master-kebiasaan') ?>" class="nav-link">
                    <i class="nav-icon far fa fa-chart-pie"></i>
                    <p>Kebiasaan</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?= Yii::$app->urlManager->createUrl('/master-kelas') ?>" class="nav-link">
                    <i class="nav-icon far fa fa-chart-pie"></i>
                    <p>Kelas</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?= Yii::$app->urlManager->createUrl('/master-kelompok-unit') ?>" class="nav-link">
                    <i class="nav-icon far fa fa-chart-pie"></i>
                    <p>Kelompok Unit</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?= Yii::$app->urlManager->createUrl('/master-pekerjaan') ?>" class="nav-link">
                    <i class="nav-icon far fa fa-chart-pie"></i>
                    <p>Pekerjaan</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?= Yii::$app->urlManager->createUrl('/master-pendidikan') ?>" class="nav-link">
                    <i class="nav-icon far fa fa-chart-pie"></i>
                    <p>Pendidikan</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?= Yii::$app->urlManager->createUrl('/master-penyakit') ?>" class="nav-link">
                    <i class="nav-icon far fa fa-chart-pie"></i>
                    <p>Penyakit</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?= Yii::$app->urlManager->createUrl('/master-riwayat') ?>" class="nav-link">
                    <i class="nav-icon far fa fa-chart-pie"></i>
                    <p>RIwayat</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?= Yii::$app->urlManager->createUrl('/master-smf') ?>" class="nav-link">
                    <i class="nav-icon far fa fa-chart-pie"></i>
                    <p>SMF</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?= Yii::$app->urlManager->createUrl('/master-status-kawin') ?>" class="nav-link">
                    <i class="nav-icon far fa fa-chart-pie"></i>
                    <p>Status Kawin</p>
                </a>
            </li>
            
            <li class="nav-item">
                <a href="<?= Yii::$app->urlManager->createUrl('/master-status-keluar') ?>" class="nav-link">
                    <i class="nav-icon far fa fa-chart-pie"></i>
                    <p>Status Keluar</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="<?= Yii::$app->urlManager->createUrl('site/about') ?>" class="nav-link">
                    <i class="nav-icon far fa fa-info-circle"></i>
                    <p>About</p>
                </a>
            </li> -->
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h5><?= Html::encode($this->title) ?></h5>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <?= Breadcrumbs::widget([
                                    'itemTemplate' => "\n\t<li class=\"breadcrumb-item\"><i>{link}</i></li>\n", // template for all links
                                    'activeItemTemplate' => "\t<li class=\"breadcrumb-item active\">{link}</li>\n", // template for the active link
                                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                                ]) ?>
                            </ol>
                        </div>
                    </div>
                </div>
            </section> -->

            <section class="content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">

                             <?php
                                foreach (Yii::$app->session->getAllFlashes() as $message) {
                                    echo SweetAlert::widget([
                                        'options' => [
                                            'title' => (!empty($message['title'])) ? Html::encode($message['title']) : '',
                                            'text' => (!empty($message['text'])) ? Html::encode($message['text']) : '',
                                            'type' => (!empty($message['type'])) ? $message['type'] : SweetAlert::TYPE_INFO,
                                            'timer' => (!empty($message['timer'])) ? $message['timer'] : 4000,
                                            'showConfirmButton' =>  (!empty($message['showConfirmButton'])) ? $message['showConfirmButton'] : true
                                        ]
                                    ]);
                                }
                            ?>
                            
                            <?= $content ?>
                        </div>
                    </div><!-- /.container-fluid -->
            </section>
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                RSUD Arifin Ahmad Provinsi Riau
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; <?= date('Y') ?> <a href="#"><?= Yii::$app->params['name-aplikasi'] ?></a>.</strong>
            All rights reserved.
        </footer>

    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->
    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>