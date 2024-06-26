<?php

namespace app\models;

use Yii;

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
            // name are required
            [['nama', 'nik', 'jenis_kelamin', 'tanggal_lahir', 'alamat', 'id_provinsi', 'id_kabupaten'], 'required'],
            [['nama'], 'string', 'max' => 256],
            [['nik'], 'string', 'max' => 256],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'nama' => 'Nama',
            'nik' => 'NIK',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tanggal_lahir' => 'Tanggal Lahir',
            'alamat' => 'Alamat',
            'id_provinsi' => 'Provinsi',
            'id_kabupaten' => 'Kabupaten',
        ];
    }

    /**
     * Gets query for [[Kabupaten]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKabupaten()
    {
        return $this->hasOne(Kabupaten::class, ['id' => 'id_kabupaten']);
    }

    public function getProvinsi()
    {
        return $this->hasOne(Provinsi::class, ['id_provinsi' => 'id_provinsi']);
    }
}
