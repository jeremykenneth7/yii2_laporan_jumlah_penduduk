<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kabupaten".
 * @property string|null $id_provinsi
 * @property string|null $id_kabupaten
 * @property string|null $nama_kabupaten 
 */

class Kabupaten extends \jeemce\models\Model
{
    public $jumlah_penduduk;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kabupaten';
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
            [['id_provinsi', 'nama_kabupaten'],'required'],
            [['id_kabupaten', 'nama_kabupaten'],'unique'],
            [['id_kabupaten'], 'string', 'max' => 5],
            [['nama_kabupaten'], 'string', 'max' => 256],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'id_kabupaten' => 'ID Kabupaten',
            'id_provinsi' => 'ID Provinsi',
            'nama_kabupaten' => 'Nama Kabupaten',
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


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->id_kabupaten = $this->generateUniqueId();
            }
            return true;
        }
        return false;
    }

    /**
     * Generate a unique ID with 2 digits
     *
     * @return string
     */
    protected function generateUniqueId()
    {
        $maxId = static::find()->max('id_kabupaten');

        if (!$maxId) {
            $id = 10;
        } else {
            $id = $maxId + 1;
        }

        return str_pad($id, 2, '0', STR_PAD_LEFT);
    }

    public function getPenduduk()
    {
        return $this->hasMany(Penduduk::class, ['id_provinsi' => 'id_provinsi']);
    }
}
