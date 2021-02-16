<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pharmacy_to_installmentcard".
 *
 * @property int $id_pharm
 * @property int $id_card
 *
 * @property InstallmentCard $card
 */
class PharmacyToInstallmentcard extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pharmacy_to_installmentcard';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pharm', 'id_card'], 'required'],
            [['id_pharm', 'id_card'], 'integer'],
            [['id_pharm', 'id_card'], 'unique', 'targetAttribute' => ['id_pharm', 'id_card']],
            [['id_card'], 'exist', 'skipOnError' => true, 'targetClass' => InstallmentCard::className(), 'targetAttribute' => ['id_card' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pharm' => 'Id Pharm',
            'id_card' => 'Id Card',
        ];
    }

    /**
     * Gets query for [[Card]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCard()
    {
        return $this->hasOne(InstallmentCard::className(), ['id' => 'id_card']);
    }
}
