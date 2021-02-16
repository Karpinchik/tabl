<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "insurance_company".
 *
 * @property int $id
 * @property string $name
 * @property int $available
 *
 * @property PharmacyRefCardRefCompany[] $pharmacyRefCardRefCompanies
 * @property PharmacyToInsurance[] $pharmacyToInsurances
 */
class InsuranceCompany extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'insurance_company';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['available'], 'integer'],
            [['name'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'available' => 'Available',
        ];
    }

    /**
     * Gets query for [[PharmacyRefCardRefCompanies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPharmacyRefCardRefCompanies()
    {
        return $this->hasMany(PharmacyRefCardRefCompany::className(), ['id_company' => 'id']);
    }

    /**
     * Gets query for [[PharmacyToInsurances]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPharmacyToInsurances()
    {
        return $this->hasMany(PharmacyToInsurance::className(), ['id_company' => 'id']);
    }
}
