<?php

namespace app\models;

use Yii;
use app\models\Provinsi;

/**
 * This is the model class for table "penduduk".
 * @property string|null $id_penduduk
 * @property string|null $nik
 * @property string|null $id_provinsi
 * @property string|null $id_kabupaten
 * @property string|null $nama 
 */

class Penduduk extends \jeemce\models\Model
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penduduk';
    }

    /**
     * {@inheritdoc}
     */


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['nama', 'nik', 'jenis_kelamin', 'tanggal_lahir', 'alamat', 'id_provinsi', 'id_kabupaten'], 'required', 'message' => '{attribute} tidak boleh kosong.'],
            [['nama'], 'string', 'max' => 100],
            [['nik'], 'string', 'max' => 18],
            [['jenis_kelamin'], 'in', 'range' => ['Laki-laki', 'Perempuan'], 'message' => 'Pilih jenis kelamin "Laki-laki" atau "Perempuan".'],
            [['tanggal_lahir'], 'date', 'format' => 'php:Y-m-d', 'message' => 'Format tanggal lahir harus yyyy-mm-dd.'],
            [['alamat'], 'string'],
            [['id_kabupaten', 'id_provinsi'], 'string', 'max' => 8],
            [['id_penduduk'], 'unique', 'message' => 'ID Penduduk sudah ada dalam sistem.'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'id_penduduk' => 'ID Penduduk',
            'nama' => 'Nama',
            'nik' => 'NIK',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tanggal_lahir' => 'Tanggal Lahir',
            'alamat' => 'Alamat',
            'id_kabupaten' => 'Kabupaten',
            'id_provinsi' => 'Provinsi',
            'timestamp' => 'Timestamp',
        ];
    }

    /**
     * Gets query for [[Kabupaten]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKabupaten()
    {
        return $this->hasOne(Kabupaten::class, ['id_kabupaten' => 'id_kabupaten']);
    }

    public function getProvinsi()
    {
        return $this->hasOne(Provinsi::class, ['id_provinsi' => 'id_provinsi']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->id_penduduk = $this->generateUniqueId();
            }
            return true;
        }
        return false;
    }

    /**
     * Generate a unique ID
     *
     * @return string
     */
    protected function generateUniqueId()
    {
        return substr(md5(uniqid(rand(), true)), 0, 8);
    }
}
