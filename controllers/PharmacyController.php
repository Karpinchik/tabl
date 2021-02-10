<?php

namespace app\controllers;

use app\models\PharmacyRefCardRefCompany;
use app\models\Pharmacy;
use app\models\InstallmentCard;
use app\models\InsuranceCompany;
use yii\web\Controller;
use Yii;

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
     * The page displays a form redaction.
     *
     * */
    public function actionEdit($id=NULL)
    {
        if ($id != NULL) {

            $id = intval($id);
            $select_cards = InstallmentCard::find()->asArray()->all();
            $select_cards[0] = NULL;

            foreach ($select_cards as $item) {
                $select_card[$item['id']] = $item['name'];
            }

            $select_companies = InsuranceCompany::find()->asArray()->all();
            $select_companies[0] = NULL;

            foreach ($select_companies as $item) {
                $select_company[$item['id']] = $item['name'];
            }

            $name_pharmacy = Yii::$app->db->createCommand('SELECT name FROM pharmacy WHERE id =:id')
                ->bindValue(':id', $id)
                ->queryOne();

            $name_pharmacy = $name_pharmacy['name'];

            /*
             * часть запроса - при добавлении к запросам $cards и $companies логика добавления параметров меняется.
             * учитываются только те карты и компании значения available которых в соответствующих таблицах имеют
             * равны 1
             * При добавлении этой части в запрос- появляется возможность неочевидного добавления карт и компаний аптекам.
             * */
//            AND insurance_company.available = 1

            $cards = Yii::$app->db->createCommand('SELECT DISTINCT installment_card.name, installment_card.available 
FROM pharmacy_ref_card_ref_company
JOIN pharmacy ON pharmacy_ref_card_ref_company.id_pharmacy = pharmacy.id
JOIN installment_card ON pharmacy_ref_card_ref_company.id_card = installment_card.id
WHERE pharmacy_ref_card_ref_company.id_pharmacy =:id')
                ->bindValue(':id', $id)
                ->queryAll();

            $companies = Yii::$app->db->createCommand('SELECT DISTINCT insurance_company.name, insurance_company.id, insurance_company.available FROM pharmacy_ref_card_ref_company 
JOIN pharmacy ON pharmacy_ref_card_ref_company.id_pharmacy = pharmacy.id
JOIN insurance_company ON pharmacy_ref_card_ref_company.id_company = insurance_company.id
WHERE pharmacy_ref_card_ref_company.id_pharmacy =:id')
                ->bindValue(':id', $id)
                ->queryAll();

            $form_data = new PharmacyRefCardRefCompany();

            if ($form_data->load(Yii::$app->request->post())) {
                if($form_data->save()) {
                    return $this->refresh();
                } else {
                    echo 'ошибка добавления записи в базу данных.';
                }
            }

            return $this->render('edit', compact('cards', 'name_pharmacy', 'companies',
                'select_card', 'select_company', 'form_data', 'id'));

        } else echo 'не передан id аптеки';
    }
}
