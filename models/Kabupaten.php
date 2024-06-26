<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kabupaten".
 * @property int $id
 * @property string|null $nilai_kode 
 */

class Kabupaten extends \jeemce\models\Model
{

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
            // name are required
            [['nama_kabupaten'], 'required'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'id_kabupaten' => 'ID',
            'nama_kabupaten' => 'Nama Kabupaten',
            'verifyCode' => 'Verification Code',
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
}
