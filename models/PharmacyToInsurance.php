<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pharmacy_to_insurance".
 *
 * @property int $id_pharm
 * @property int $id_company
 *
 * @property InsuranceCompany $company
 */
class PharmacyToInsurance extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pharmacy_to_insurance';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_pharm', 'id_company'], 'required'],
            [['id_pharm', 'id_company'], 'integer'],
            [['id_pharm', 'id_company'], 'unique', 'targetAttribute' => ['id_pharm', 'id_company']],
            [['id_company'], 'exist', 'skipOnError' => true, 'targetClass' => InsuranceCompany::className(), 'targetAttribute' => ['id_company' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pharm' => 'Id Pharm',
            'id_company' => 'Id Company',
        ];
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
