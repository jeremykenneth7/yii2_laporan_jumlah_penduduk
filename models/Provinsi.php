<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "provinsi".
 * @property int $id
 * @property string|null $nilai_kode 
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
            [['nama_provinsi'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'id_provinsi' => 'ID',
            'nama_provinsi' => 'Nama Provinsi',
            'verifyCode' => 'Verification Code',
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
