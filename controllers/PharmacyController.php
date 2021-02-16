<?php

namespace app\controllers;

use app\models\Pharmacy;
use app\models\InstallmentCard;
use app\models\InsuranceCompany;
use yii\web\Controller;
use Yii;
use app\models\PharmacyToInstallmentcard;
use app\models\PharmacyToInsurance;
use yii\helpers\Url;

class PharmacyController extends Controller
{
    /**
     * The page is main.
     * The page displays a list of pharmacies.
     *
     * */
    public function actionIndex()
    {
        $pharms = Pharmacy::find()->all();
        return $this->render('index', compact('pharms'));
    }

    /**
     * The action removes items.
     *
     * */
    public function actionDel()
    {
       $id = $_GET['id_pharm'];

       if($_GET['tbl'] == 'pharmacy_to_installmentcard') {
           Yii::$app->db->createCommand("DELETE FROM `pharmacy_to_installmentcard` 
WHERE `pharmacy_to_installmentcard`.`id_pharm` =".$_GET['id_pharm']." 
AND `pharmacy_to_installmentcard`.`id_card` =".$_GET['id_card'])->execute();
       } elseif ($_GET['tbl'] == 'pharmacy_to_insurance') {
            Yii::$app->db->createCommand("DELETE FROM `pharmacy_to_insurance` 
WHERE `pharmacy_to_insurance`.`id_pharm` =".$_GET['id_pharm']." 
AND `pharmacy_to_insurance`.`id_company` =".$_GET['id_company'])->execute();
       }

       $url = Url::to(['pharmacy/edit', 'id' => $id]);
       return $this->redirect($url);
    }


    /**
     * The page displays a form redaction.
     *
     * */
    public function actionEdit($id=NULL)
    {
        if ($id != NULL) {

            $form_data_company = new PharmacyToInsurance();
            if ($form_data_company->load(Yii::$app->request->post())) {
                if($form_data_company->save()) {
                    return $this->refresh();
                } else {
                    $error_form['er'] = 'эта карта уже прикреплена к данной аптеке';
                }
            }

            $form_data_card = new PharmacyToInstallmentcard();
            if ($form_data_card->load(Yii::$app->request->post())) {
                if($form_data_card->save()) {
                    return $this->refresh();
                } else {
                    $error_form['er'] = 'эта компания уже прикреплена к данной аптеке';
                }
            }

            $select_cards = InstallmentCard::find()->where(['available' => 1])->asArray()->all();
            $select_cards_all = InstallmentCard::find()->where(['available' => 0])->asArray()->all();
            array_unshift($select_cards, 0);

            foreach ($select_cards as $item) {
                $select_card[$item['id']] = $item['name'];
            }

            $select_companies = InsuranceCompany::find()->where(['available' => 1])->asArray()->all();
            $select_companies_all = InsuranceCompany::find()->where(['available' => 0])->asArray()->all();
            array_unshift($select_companies, 0);

            foreach ($select_companies as $item) {
                $select_company[$item['id']] = $item['name'];
            }

            $name_pharmacy = Yii::$app->db->createCommand('SELECT name FROM pharmacy WHERE id =:id')
                ->bindValue(':id', $id)->queryOne();

            $is_company_to_pharm = Yii::$app->db->createCommand('SELECT DISTINCT * FROM pharmacy_to_installmentcard JOIN
installment_card ON pharmacy_to_installmentcard.id_card = installment_card.id WHERE id_pharm ='.$id)->queryAll();


            $is_card_to_pharm = Yii::$app->db->createCommand('SELECT DISTINCT * FROM pharmacy_to_insurance JOIN
insurance_company ON pharmacy_to_insurance.id_company = insurance_company.id WHERE id_pharm ='.$id)->queryAll();

            return $this->render('edit', compact( 'id', 'is_card_to_pharm', 'is_company_to_pharm',
                'cards', 'select_card', 'select_cards_all', 'select_company', 'select_companies_all',
                'form_data_company', 'form_data_card', 'error_form', 'name_pharmacy', 'res', 'ok'));

        } else echo 'не передан id аптеки';
    }
}
