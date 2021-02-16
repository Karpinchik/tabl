<?php

namespace app\models;
use yii\db\ActiveRecord;
use Yii;

/**
 * This is the model class for table "installment_card".
 *
 * @property int $id
 * @property string $name
 * @property int $available
 *
 * @property PharmacyRefCardRefCompany[] $pharmacyRefCardRefCompanies
 * @property PharmacyToInstallmentcard[] $pharmacyToInstallmentcards
 */
class InstallmentCard extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'installment_card';
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
        return $this->hasMany(PharmacyRefCardRefCompany::className(), ['id_card' => 'id']);
    }

    /**
     * Gets query for [[PharmacyToInstallmentcards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPharmacyToInstallmentcards()
    {
        return $this->hasMany(PharmacyToInstallmentcard::className(), ['id_card' => 'id']);
    }
}
