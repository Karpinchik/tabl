<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pharmacy_ref_card_ref_company".
 *
 * @property int $id
 * @property int|null $id_pharmacy
 * @property int|null $id_card
 * @property int|null $id_company
 *
 * @property Pharmacy $pharmacy
 * @property InstallmentCard $card
 * @property InsuranceCompany $company
 */
class PharmacyRefCardRefCompany extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pharmacy_ref_card_ref_company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pharmacy', 'id_card', 'id_company'], 'integer'],
            [['id_pharmacy'], 'exist', 'skipOnError' => true, 'targetClass' => Pharmacy::className(), 'targetAttribute' => ['id_pharmacy' => 'id']],
            [['id_card'], 'exist', 'skipOnError' => true, 'targetClass' => InstallmentCard::className(), 'targetAttribute' => ['id_card' => 'id']],
            [['id_company'], 'exist', 'skipOnError' => true, 'targetClass' => InsuranceCompany::className(), 'targetAttribute' => ['id_company' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_pharmacy' => 'Id Pharmacy',
            'id_card' => 'Id Card',
            'id_company' => 'Id Company',
        ];
    }

    /**
     * Gets query for [[Pharmacy]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPharmacy()
    {
        return $this->hasOne(Pharmacy::className(), ['id' => 'id_pharmacy']);
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

    /**
     * Gets query for [[Company]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCompany()
    {
        return $this->hasOne(InsuranceCompany::className(), ['id' => 'id_company']);
    }
}
