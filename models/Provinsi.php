<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "provinsi".
 * @property string|null $id_provinsi
 * @property string|null $nama_provinsi 
 */

class Provinsi extends \jeemce\models\Model
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'provinsi';
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
            [['id_provinsi', 'nama_provinsi'], 'required'],
            [['id_provinsi'], 'number'],
            [['nama'], 'string', 'max' => 256],
            [['id_provinsi'], 'unique'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'id_provinsi' => 'Kode Provinsi',
            'nama_provinsi' => 'Nama Provinsi',
        ];
    }

    /**
     * Gets query for [[Provinsi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvinsi()
    {
        return $this->hasOne(Provinsi::class, ['id' => 'id_provinsi']);
    }

    /**
     * Gets query for [[Provinsis]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvinsis()
    {
        return $this->hasMany(Provinsi::class, ['id' => 'id_provinsi']);
    }
}
