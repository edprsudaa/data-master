<?php

namespace app\components;

use app\models\medis\Cppt;
use Yii;
use app\models\pendaftaran\Layanan;
use app\models\medis\Pjp;
use app\models\medis\PjpRi;
use app\models\medis\ItemPemeriksaanPenunjang;
use app\models\pegawai\DmUnitPenempatan;
use app\models\TbPegawai;
use app\models\pegawai\TbRiwayatPenempatan;
use app\models\pegawai\TbUnitPltPlh;
use app\models\AknApp;
use app\models\AksesUnit;
// use app\models\PegawaiUser;
use app\models\AkunAknUser;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;

class HelperSpesial
{
  const LEVEL_ROOT = 'ROOT';
  const LEVEL_ADMIN = 'ADMIN';
  const LEVEL_PERAWAT = 'PERAWAT';
  const LEVEL_BIDAN = 'BIDAN';
  const LEVEL_DOKTER = 'DOKTER';
  const LEVEL_KETEKNISIAN_MEDIS = 'KETEKNISIAN_MEDIS';
  const LEVEL_ADM = 'ADM';

  const SDM_RUMPUN_MEDIS = '1';
  const SDM_RUMPUN_PERAWAT = '3';
  const SDM_RUMPUN_BIDAN = '4';
  const SDM_RUMPUN_KETEKNISIAN_MEDIS = '10';

  public static function getUserLogin()
  {
    $login = Yii::$app->user->identity;
    $akun = $login->akun;
    $level = null;
    $pesannoakses = null;
    $akses = true;
    if (strtoupper($login->roles) == 'MEDIS') {
      if (in_array($login['idData'], self::getListDokter(false))) {
        $level = self::LEVEL_DOKTER;
      } else {
        $akses = false;
        $pesannoakses = 'PEGAWAI BUKAN RUMPUN MEDIS';
      }
    } else if (strtoupper($login->roles) == 'KEPERAWATAN') {
      // if(in_array($login['idData'],self::getListPerawat(false))){
      if (in_array($login['idData'], self::getListPerawatBidan(false))) {
        $level = self::LEVEL_PERAWAT;
      } else {
        $akses = false;
        // $pesannoakses='STR / SIP/ SP KLINIS TIDAK TERSEDIA/TIDAK BERLAKU';
        $pesannoakses = 'PEGAWAI BUKAN RUMPUN KEPERAWATAN';
      }
    } else if (strtoupper($login->roles) == 'KEBIDANAN') {
      // if(in_array($login['idData'],self::getListBidan(false))){
      if (in_array($login['idData'], self::getListPerawatBidan(false))) {
        $level = self::LEVEL_BIDAN;
      } else {
        $akses = false;
        // $pesannoakses='STR / SIP/ SP KLINIS TIDAK TERSEDIA/TIDAK BERLAKU';
        $pesannoakses = 'PEGAWAI BUKAN RUMPUN KEBIDANAN';
      }
    } else if (strtoupper($login->roles) == 'ROOT') {
      $level = self::LEVEL_ROOT;
    } else if (strtoupper($login->roles) == 'NONMEDIS') {
      $level = self::LEVEL_ADM;
    }
    return [
      'akses' => $akses,
      'pesannoakses' => $pesannoakses,
      'user_id' => $login['id'],
      'username' => $akun->username,
      'pegawai_id' => $login['idData'],
      'nama' => Akun::user()->name,
      'akses_level' => $level
    ];
  }

  public static function getListPerawatBidan($original = true, $list = false)
  {
    $result = TbPegawai::find()->select([TbPegawai::tableName() . '.id_nip_nrp', 'pegawai_id', new \yii\db\Expression("CONCAT(" . TbPegawai::tableName() . ".id_nip_nrp,' | ',gelar_sarjana_depan, ' ',nama_lengkap,' ',gelar_sarjana_belakang) as nama")])->innerjoinWith([
      'riwayatPenempatan' => function ($q) {
        $q->where(['or', [TbRiwayatPenempatan::tableName() . '.sdm_rumpun' => self::SDM_RUMPUN_PERAWAT], [TbRiwayatPenempatan::tableName() . '.sdm_rumpun' => self::SDM_RUMPUN_BIDAN], [TbRiwayatPenempatan::tableName() . '.sdm_rumpun' => self::SDM_RUMPUN_KETEKNISIAN_MEDIS]])->orderBy([TbRiwayatPenempatan::tableName() . '.tanggal' => SORT_DESC])->limit(1);
      }
    ])
      ->where([TbPegawai::tableName() . '.status_aktif_pegawai' => 1])->asArray()->all();
    if ($original) {
      return $result;
    } else {
      if ($list) {
        return ArrayHelper::map($result, 'pegawai_id', 'nama');
      } else {
        return ArrayHelper::getColumn($result, 'pegawai_id');
      }
    }
  }

  public static function isDokter($user = [])
  {
    if (!$user) {
      $user = self::getUserLogin();
    }
    if (strtoupper($user['akses_level']) === self::LEVEL_DOKTER) {
      return $user;
    }
    return [];
  }

  public static function getDataPegawaiByNomor($nomor)
  {
    return TbPegawai::find()->where(['pgw_nomor' => $nomor])->one();
  }
  public static function getDataPegawaiById($id)
  {
    return TbPegawai::find()->where(['pegawai_id' => $id])->one();
  }
  public static function getDataPegawaiByUserid($id)
  {
    return PegawaiUser::find()->joinWith(['pegawai'])->where(['userid' => $id])->one();
  }
  public static function getNamaPegawai($pegawai)
  {
    return ($pegawai->gelar_sarjana_depan ? $pegawai->gelar_sarjana_depan . ' ' : null) . $pegawai->nama_lengkap . ($pegawai->gelar_sarjana_belakang ? ', ' . $pegawai->gelar_sarjana_belakang : null);
  }
  public static function getNamaPegawaiArray($pegawai)
  {
    return ($pegawai['gelar_sarjana_depan'] ? $pegawai['gelar_sarjana_depan'] . ' ' : null) . $pegawai['nama_lengkap'] . ($pegawai['gelar_sarjana_belakang'] ? ', ' . $pegawai['gelar_sarjana_belakang'] : null);
  }
  public static function getListPegawai($aktif = 0, $original = true, $list = false)
  {
    $result = array();
    $query = TbPegawai::find();
    $query->joinWith([
      'riwayatPenempatan.unitKerja'
    ])->orderBy(['id_nip_nrp' => SORT_DESC]);
    if ($aktif > 0) {
      $query->where(['status_aktif_pegawai' => 1]);
    }

    // $query->andWhere(['or', [TbRiwayatPenempatan::tableName() . '.unit_kerja' => 137], [TbRiwayatPenempatan::tableName() . '.unit_kerja' => 141], [DmUnitPenempatan::tableName() . '.is_ok' => 1]]);

    $query->andWhere(['or', [TbRiwayatPenempatan::tableName() . '.sdm_rumpun' => 1], [TbRiwayatPenempatan::tableName() . '.sdm_rumpun' => 3], [TbRiwayatPenempatan::tableName() . '.sdm_rumpun' => 10], [TbRiwayatPenempatan::tableName() . '.sdm_rumpun' => 4], [TbPegawai::tableName() . '.id_nip_nrp' => Yii::$app->params['other']['username_root_bedah_sentral']]]);

    $result = $query->asArray()->all();

    $list_result = array();
    foreach ($result as $v) {
      array_push($list_result, ['id' => $v['pegawai_id'], 'nama' => self::getNamaPegawaiArray($v)]);
    }

    if ($original) {
      return $list_result;
    } else {
      if ($list) {
        return ArrayHelper::map($list_result, 'id', 'nama');
      } else {
        return ArrayHelper::getColumn($list_result, 'id');
      }
    }
  }
  public static function getListUser($aktif = 0, $original = true, $list = false)
  {
    $result = array();
    $query = AkunAknUser::find();
    $query->joinWith([
      'pegawai.riwayatPenempatan.unitKerja'
    ])->orderBy([TbPegawai::tableName() . '.id_nip_nrp' => SORT_DESC]);
    if ($aktif > 0) {
      $query->where([TbPegawai::tableName() . '.status_aktif_pegawai' => 1]);
    }

    // $query->andWhere(['or', [TbRiwayatPenempatan::tableName() . '.sdm_rumpun' => 1], [TbRiwayatPenempatan::tableName() . '.sdm_rumpun' => 3], [TbRiwayatPenempatan::tableName() . '.sdm_rumpun' => 10]]);
    $result = $query->asArray()->all();

    $list_result = array();
    // echo "<pre>";
    // print_r($result);
    // die;
    foreach ($result as $v) {
      if ($v['pegawai'] != null) {
        array_push($list_result, ['id' => $v['userid'], 'nama' => self::getNamaPegawaiArray($v['pegawai']) . " - " . $v['username']]);
      }
    }

    if ($original) {
      return $list_result;
    } else {
      if ($list) {
        return ArrayHelper::map($list_result, 'id', 'nama');
      } else {
        return ArrayHelper::getColumn($list_result, 'id');
      }
    }
  }
  public static function getListDokter($original = true, $list = false)
  {
    //bisa by tb_riwayat_penempatan where sdm_rumpun=1
    $result = TbPegawai::find()->select([TbPegawai::tableName() . '.id_nip_nrp', 'pegawai_id', new \yii\db\Expression("CONCAT(" . TbPegawai::tableName() . ".id_nip_nrp,' | ',gelar_sarjana_depan, ' ',nama_lengkap,' ',gelar_sarjana_belakang) as nama")])->innerjoinWith([
      'riwayatPenempatan' => function ($q) {
        $q->where(['or', [TbRiwayatPenempatan::tableName() . '.id_nip_nrp' => Yii::$app->params['other']['username_root_bedah_sentral']], [TbRiwayatPenempatan::tableName() . '.sdm_rumpun' => 1]])->orderBy([TbRiwayatPenempatan::tableName() . '.tanggal' => SORT_DESC])->active()->limit(1);
      }
    ])->where([TbPegawai::tableName() . '.status_aktif_pegawai' => 1])->asArray()->all();
    // echo "<pre>";
    // print_r($result);
    // die;
    if (!$result) {
      $result = TbPegawai::find()->select([TbPegawai::tableName() . '.id_nip_nrp', 'pegawai_id', new \yii\db\Expression("CONCAT(" . TbPegawai::tableName() . ".id_nip_nrp,' | ',gelar_sarjana_depan, ' ',nama_lengkap,' ',gelar_sarjana_belakang) as nama")])->innerjoinWith([
        'pltPlh' => function ($q) {
          $q->where([TbUnitPltPlh::tableName() . '.sdm_rumpun' => 1])->orderBy([TbUnitPltPlh::tableName() . '.tanggal_surat' => SORT_DESC])->active()->limit(1);
        }
      ])->where([TbPegawai::tableName() . '.status_aktif_pegawai' => 1])->asArray()->all();
    }
    if ($original) {
      return $result;
    } else {
      if ($list) {
        return ArrayHelper::map($result, 'pegawai_id', 'nama');
      } else {
        return ArrayHelper::getColumn($result, 'pegawai_id');
      }
    }
  }
  public static function getListPjp($layanan, $original = true, $list = false)
  {
    //return pjp_id=>pegawai_nama
    $result = array();
    if ($layanan['jenis_layanan'] === Layanan::RI) {
      //RI
      $query = PjpRi::find()
        ->select([PjpRi::tableName() . '.id', PjpRi::tableName() . '.pegawai_id', TbPegawai::tableName() . '.id_nip_nrp', TbPegawai::tableName() . '.pegawai_id', new \yii\db\Expression("CONCAT(gelar_sarjana_depan, ' ',nama_lengkap,' ',gelar_sarjana_belakang) as nama")])
        ->joinWith([
          'pegawai'
        ]);
      $query->andWhere([PjpRi::tableName() . '.registrasi_kode' => $layanan['registrasi_kode']]);
      $result = $query->asArray()->all();
    } else {
      //RJ/IGD/PENUNJANG
      $query = Pjp::find()
        ->select([Pjp::tableName() . '.id', Pjp::tableName() . '.pegawai_id', TbPegawai::tableName() . '.id_nip_nrp', TbPegawai::tableName() . '.pegawai_id', new \yii\db\Expression("CONCAT(gelar_sarjana_depan, ' ',nama_lengkap,' ',gelar_sarjana_belakang) as nama")])
        ->joinWith([
          'pegawai'
        ]);
      $query->andWhere([Pjp::tableName() . '.layanan_id' => $layanan['id']]);
      $result = $query->asArray()->all();
    }
    if ($original) {
      return $result;
    } else {
      if ($list) {
        return ArrayHelper::map($result, 'id', 'nama');
      } else {
        return ArrayHelper::getColumn($result, 'id');
      }
    }
  }
  public static function getListPegawaiPjp($layanan, $original = true, $list = false)
  {
    //return pegawai_id=>pegawai_nama
    $result = array();
    if ($layanan['jenis_layanan'] === Layanan::RI) {
      //RI
      $query = PjpRi::find()
        ->select([PjpRi::tableName() . '.id', PjpRi::tableName() . '.pegawai_id', TbPegawai::tableName() . '.id_nip_nrp', TbPegawai::tableName() . '.pegawai_id', new \yii\db\Expression("CONCAT(gelar_sarjana_depan, ' ',nama_lengkap,' ',gelar_sarjana_belakang) as nama")])
        ->joinWith([
          'pegawai'
        ]);
      $query->andWhere([PjpRi::tableName() . '.registrasi_kode' => $layanan['registrasi_kode']]);
      $result = $query->asArray()->all();
    } else {
      //RJ/IGD/PENUNJANG
      $query = Pjp::find()
        ->select([Pjp::tableName() . '.id', Pjp::tableName() . '.pegawai_id', TbPegawai::tableName() . '.id_nip_nrp', TbPegawai::tableName() . '.pegawai_id', new \yii\db\Expression("CONCAT(gelar_sarjana_depan, ' ',nama_lengkap,' ',gelar_sarjana_belakang) as nama")])
        ->joinWith([
          'pegawai'
        ]);
      $query->andWhere([Pjp::tableName() . '.layanan_id' => $layanan['id']]);
      $result = $query->asArray()->all();
    }
    if ($original) {
      return $result;
    } else {
      if ($list) {
        return ArrayHelper::map($result, 'pegawai_id', 'nama');
      } else {
        return ArrayHelper::getColumn($result, 'pegawai_id');
      }
    }
  }
  public static function getListUnitLayanan($type = null, $original = true, $list = false)
  {
    $unit = array();
    if ($type == Layanan::RJ) {
      $unit = DmUnitPenempatan::find()->select(['kode', 'nama'])->where(['is_rj' => 1])->andWhere('aktif = 1')->andWhere('is_deleted is null')->orderBy(['nama' => SORT_ASC])->asArray()->all();
    } else if ($type == Layanan::RI) {
      $unit = DmUnitPenempatan::find()->select(['kode', 'nama'])->where(['is_ri' => 1])->andWhere('aktif = 1')->andWhere('is_deleted is null')->orderBy(['nama' => SORT_ASC])->asArray()->all();
    } else if ($type == Layanan::IGD) {
      $unit = DmUnitPenempatan::find()->select(['kode', 'nama'])->where(['is_igd' => 1])->andWhere('aktif = 1')->andWhere('is_deleted is null')->orderBy(['nama' => SORT_ASC])->asArray()->all();
    } else if ($type == Layanan::PENUNJANG) {
      $unit = DmUnitPenempatan::find()->select(['kode', 'nama'])->where(['is_penunjang' => 1])->andWhere('aktif = 1')->andWhere('is_deleted is null')->orderBy(['nama' => SORT_ASC])->asArray()->all();
    } else if ($type == Layanan::OK) {
      $unit = DmUnitPenempatan::find()->select(['kode', 'nama'])->where(['is_ok' => 1])->andWhere('aktif = 1')->andWhere('is_deleted is null')->orderBy(['nama' => SORT_ASC])->asArray()->all();
    } else {
      $unit = DmUnitPenempatan::find()->select(['kode', 'nama'])->where(['or', ['is_rj' => 1], ['is_ri' => 1], ['is_igd' => 1], ['is_penunjang' => 1], ['is_ok' => 1]])->andWhere('aktif = 1')->andWhere('is_deleted is null')->orderBy(['nama' => SORT_ASC])->asArray()->all();
    }
    if ($original) {
      return $unit;
    } else {
      if ($list) {
        return ArrayHelper::map($unit, 'kode', 'nama');
      } else {
        return ArrayHelper::getColumn($unit, 'kode');
      }
    }
  }
  public static function getListUnitOK($original = true, $list = false)
  {
    $unit = array();
    $unit = DmUnitPenempatan::find()->select(['kode', 'nama'])->where(['is_ok' => 1])->andWhere('aktif = 1')->andWhere('is_deleted is null')->orderBy(['nama' => SORT_ASC])->asArray()->all();
    if ($original) {
      return $unit;
    } else {
      if ($list) {
        return ArrayHelper::map($unit, 'kode', 'nama');
      } else {
        return ArrayHelper::getColumn($unit, 'id');
      }
    }
  }
  public static function getListAplikasi($original = true, $list = false)
  {
    $aplikasi = array();
    $aplikasi = AknApp::find()->select(['id', 'nma'])
      ->andWhere(['or', ['id' => \Yii::$app->params['app']['id']], ['id' => 23]])
      ->orderBy(['nma' => SORT_ASC])->asArray()->all();
    if ($original) {
      return $aplikasi;
    } else {
      if ($list) {
        return ArrayHelper::map($aplikasi, 'id', 'nma');
      } else {
        return ArrayHelper::getColumn($aplikasi, 'id');
      }
    }
  }
  public static function getCheckPasien($id)
  {
    // $id => layanan_id
    // $layanan=array();
    if (!is_numeric($id)) {
      $id = HelperGeneral::validateData($id);
    }
    if (!$id) {
      return MakeResponse::createNotJson(false, 'Pasien Tidak Valid, Mohon Pilih Lagi');
    }
    $layanan = Layanan::find()->joinWith([
      'unit',
      'registrasi.pasien',
      'registrasi.debiturDetail',
      'registrasi.pjpRi.pegawai',
      'pjp.pegawai',
    ])->where([Layanan::tableName() . '.id' => $id])->asArray()->one();
    if (!$layanan) {
      return MakeResponse::createNotJson(false, 'Pasien Tidak Valid, Mohon Pilih Lagi');
    }
    return MakeResponse::createNotJson(true, null, $layanan);
  }
  public static function checkAllowCRUDbyLayanan($pl_id)
  {
    //chek allow create data asuhan-asuhan pasien
    return MakeResponse::createNotJson(true, 'oke');
  }
  public static function checkAllowCRUDbyRegistrasi($reg_kode)
  {
    //chek allow create data asuhan-asuhan pasien
    return MakeResponse::createNotJson(true, 'oke');
  }
  //FOR PENUNJANG ORDER
  public static function PenunjangKonversiStringKeArray($items)
  {
    $items = str_replace(' ', '', $items);
    if ($items) {
      //konversi dari string(,) ke array => ex : 12,11 =>[12,11]
      $array_items = explode(",", $items);
      if ($array_items) {
        return $array_items;
      }
    }
    return array();
  }

  public static function RekonItemPemeriksaanPenunjang($array_items)
  {
    // $list_items = ItemPemeriksaanPenunjang::getDataQuery();
    $list_items = ItemPemeriksaanPenunjang::getListData();
    if ($list_items) {
      $list_items2 = array();
      foreach ($list_items as $val) {
        if (in_array(intval($val['ipp_id']), $array_items)) {
          array_push($list_items2, $val);
        }
      }
      return $list_items2;
    }
    return array();
  }
  //END PENUNJANG ORDER
  public static function getHitungBiayaTindakan($data, $object = true)
  {
    if ($object) {
      return
        [
          'standar' => intval($data->js_adm) + intval($data->js_sarana) + intval($data->js_bhp) + intval($data->js_dokter_operator) + intval($data->js_dokter_lainya) + intval($data->js_dokter_anastesi) + intval($data->js_penata_anastesi) + intval($data->js_paramedis) + intval($data->js_lainya),
          'cyto' => intval($data->js_adm_cto) + intval($data->js_sarana_cto) + intval($data->js_bhp_cto) + intval($data->js_dokter_operator_cto) + intval($data->js_dokter_lainya_cto) + intval($data->js_dokter_anastesi_cto) + intval($data->js_penata_anastesi_cto) + intval($data->js_paramedis_cto) + intval($data->js_lainya_cto)
        ];
    } else {
      return
        [
          'standar' => intval($data['js_adm']) + intval($data['js_sarana']) + intval($data['js_bhp']) + intval($data['js_dokter_operator']) + intval($data['js_dokter_lainya']) + intval($data['js_dokter_anastesi']) + intval($data['js_penata_anastesi']) + intval($data['js_paramedis']) + intval($data['js_lainya']),
          'cyto' => intval($data['js_adm_cto']) + intval($data['js_sarana_cto']) + intval($data['js_bhp_cto']) + intval($data['js_dokter_operator_cto']) + intval($data['js_dokter_lainya_cto']) + intval($data['js_dokter_anastesi_cto']) + intval($data['js_penata_anastesi_cto']) + intval($data['js_paramedis_cto']) + intval($data['js_lainya_cto'])
        ];
    }
  }
}
