<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "pharmacy".
 *
 * @property int $id
 * @property string $name
 * @property string $small_name
 * @property string $address
 * @property int $region_id
 * @property int $net_id
 * @property string $administrator
 * @property string $phone
 * @property string $phone_int
 * @property int $web_id
 * @property string $identifier
 * @property int $connected
 * @property string $create_at
 * @property int $update_at
 * @property int $modify_at
 * @property int $available
 * @property int $archived
 * @property int $industrial
 * @property int $state
 * @property string $notice
 * @property int $type_show_price
 * @property int $type_show_amount
 * @property int $is_use_net_type
 * @property int $uid
 * @property int $subclaster_id
 * @property int $subclaster_report_id
 * @property float $geo_x
 * @property float $geo_y
 * @property string $yandex_map
 * @property float $t_geo_x
 * @property float $t_geo_y
 * @property int $is24
 * @property string $mon
 * @property string $tues
 * @property string $wedn
 * @property string $thur
 * @property string $fri
 * @property string $sat
 * @property string $san
 * @property string $remark
 * @property int $action_id
 * @property int $reservation_url_id
 * @property int $is_delivery
 * @property int $is_reservation
 * @property int|null $pharm_type 1-аптека, 2-оптика,3-медтехника,4-интернет-магазин,5-бад
 *
 * @property Action $action
 * @property Net $net
 * @property RegionSite $region
 * @property ResarvationUrl $reservationUrl
 * @property Subclaster $subclaster
 * @property WebUrl $web
 */
class Pharmacy extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'pharmacy';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['region_id', 'net_id', 'web_id', 'connected', 'update_at', 'modify_at', 'available', 'archived', 'industrial', 'state', 'type_show_price', 'type_show_amount', 'is_use_net_type', 'uid', 'subclaster_id', 'subclaster_report_id', 'is24', 'action_id', 'reservation_url_id', 'is_delivery', 'is_reservation', 'pharm_type'], 'integer'],
            [['create_at'], 'required'],
            [['create_at'], 'safe'],
            [['geo_x', 'geo_y', 't_geo_x', 't_geo_y'], 'number'],
            [['name', 'address', 'administrator', 'phone', 'phone_int', 'identifier', 'notice'], 'string', 'max' => 191],
            [['small_name'], 'string', 'max' => 20],
            [['yandex_map'], 'string', 'max' => 255],
            [['mon', 'tues', 'wedn', 'thur', 'fri', 'sat', 'san'], 'string', 'max' => 50],
            [['remark'], 'string', 'max' => 250],
            [['name', 'address', 'net_id'], 'unique', 'targetAttribute' => ['name', 'address', 'net_id']],
            [['action_id'], 'exist', 'skipOnError' => true, 'targetClass' => Action::className(), 'targetAttribute' => ['action_id' => 'id']],
            [['net_id'], 'exist', 'skipOnError' => true, 'targetClass' => Net::className(), 'targetAttribute' => ['net_id' => 'id']],
            [['region_id'], 'exist', 'skipOnError' => true, 'targetClass' => RegionSite::className(), 'targetAttribute' => ['region_id' => 'id']],
            [['reservation_url_id'], 'exist', 'skipOnError' => true, 'targetClass' => ResarvationUrl::className(), 'targetAttribute' => ['reservation_url_id' => 'id']],
            [['subclaster_id'], 'exist', 'skipOnError' => true, 'targetClass' => Subclaster::className(), 'targetAttribute' => ['subclaster_id' => 'id']],
            [['web_id'], 'exist', 'skipOnError' => true, 'targetClass' => WebUrl::className(), 'targetAttribute' => ['web_id' => 'id']],
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
            'small_name' => 'Small Name',
            'address' => 'Address',
            'region_id' => 'Region ID',
            'net_id' => 'Net ID',
            'administrator' => 'Administrator',
            'phone' => 'Phone',
            'phone_int' => 'Phone Int',
            'web_id' => 'Web ID',
            'identifier' => 'Identifier',
            'connected' => 'Connected',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'modify_at' => 'Modify At',
            'available' => 'Available',
            'archived' => 'Archived',
            'industrial' => 'Industrial',
            'state' => 'State',
            'notice' => 'Notice',
            'type_show_price' => 'Type Show Price',
            'type_show_amount' => 'Type Show Amount',
            'is_use_net_type' => 'Is Use Net Type',
            'uid' => 'Uid',
            'subclaster_id' => 'Subclaster ID',
            'subclaster_report_id' => 'Subclaster Report ID',
            'geo_x' => 'Geo X',
            'geo_y' => 'Geo Y',
            'yandex_map' => 'Yandex Map',
            't_geo_x' => 'T Geo X',
            't_geo_y' => 'T Geo Y',
            'is24' => 'Is24',
            'mon' => 'Mon',
            'tues' => 'Tues',
            'wedn' => 'Wedn',
            'thur' => 'Thur',
            'fri' => 'Fri',
            'sat' => 'Sat',
            'san' => 'San',
            'remark' => 'Remark',
            'action_id' => 'Action ID',
            'reservation_url_id' => 'Reservation Url ID',
            'is_delivery' => 'Is Delivery',
            'is_reservation' => 'Is Reservation',
            'pharm_type' => 'Pharm Type',
        ];
    }

    /**
     * Gets query for [[Action]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAction()
    {
        return $this->hasOne(Action::className(), ['id' => 'action_id']);
    }

    /**
     * Gets query for [[Net]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNet()
    {
        return $this->hasOne(Net::className(), ['id' => 'net_id']);
    }

    /**
     * Gets query for [[Region]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(RegionSite::className(), ['id' => 'region_id']);
    }

    /**
     * Gets query for [[ReservationUrl]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReservationUrl()
    {
        return $this->hasOne(ResarvationUrl::className(), ['id' => 'reservation_url_id']);
    }

    /**
     * Gets query for [[Subclaster]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubclaster()
    {
        return $this->hasOne(Subclaster::className(), ['id' => 'subclaster_id']);
    }

    /**
     * Gets query for [[Web]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWeb()
    {
        return $this->hasOne(WebUrl::className(), ['id' => 'web_id']);
    }
}
