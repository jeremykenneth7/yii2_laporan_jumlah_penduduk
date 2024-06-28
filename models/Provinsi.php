<?php

namespace app\models;

use Yii;
use app\models\Kabupaten;

/**
 * This is the model class for table "provinsi".
 * 
 * @property string|null $id_provinsi
 * @property string|null $nama_provinsi
 */
class Provinsi extends \jeemce\models\Model
{
    public $jumlah_penduduk;
    public $nama_kabupaten;
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
    public function rules()
    {
        return [
            [['nama_provinsi'], 'required'],
            [['id_provinsi'], 'number', 'max' => 3],
            [['nama_provinsi'], 'string', 'max' => 256],
            [['id_provinsi'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_provinsi' => 'ID Provinsi',
            'nama_provinsi' => 'Nama Provinsi',
        ];
    }

    /**
     * Automatically generate a unique ID before saving the model
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->id_provinsi = $this->generateUniqueId();
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
        $maxId = static::find()->max('id_provinsi');

        if (!$maxId) {
            $id = 95;
        } else {
            $id = $maxId + 1;
        }

        return str_pad($id, 2, '0', STR_PAD_LEFT);
    }

    public function getKabupaten()
    {
        return $this->hasMany(Kabupaten::class, ['id_provinsi' => 'id_provinsi']);
    }

    public function getPenduduk()
    {
        return $this->hasMany(Penduduk::class, ['id_provinsi' => 'id_provinsi']);
    }
}
