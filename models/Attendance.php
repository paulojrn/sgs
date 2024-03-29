<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Attendance extends ActiveRecord
{    
    public static function tableName()
    {
        return 'sgsdb.attendance';
    }
    
    public function getUserName()
    {
        $username = '';
        
        if($this->user_id){
            $username = User::find()->select('username')->where('id = '.$this->user_id)->one()->username;
        }
        
        return $username;
    }
    
    public function setQueueId(){
        $session = Yii::$app->session;
        $type = $this->getAttribute('type');
        $queueId = '';
        
        $session->open();
        
        if(is_null($session->get('n')) || (intval($session->get('n')) > 9999)){
            $session->set('n', 0);
        }
        
        if(is_null($session->get('p')) || (intval($session->get('p')) > 9999)){
            $session->set('p', 0);
        }
        
        if(strcmp($type, 'N') == 0){
            $queueId = $type.str_pad($session->get('n'), 4, "0", STR_PAD_LEFT);
            $session->set('n', $session->get('n') + 1);
        }
        else{ //P
            $queueId = $type.str_pad($session->get('p'), 4, "0", STR_PAD_LEFT);
            $session->set('p', $session->get('p') + 1);
        }
        
        $session->close();

        $this->setAttribute('queueid', $queueId);
    }
    
    public static function resetCounters($param){
        $session = Yii::$app->session;
        $session->open();
        
        switch ($param) {
            case 'N':
                $session->set('n', 0);
                break;
            case 'P':
                $session->set('p', 0);
                break;

            default:
                $session->set('n', 0);
                $session->set('p', 0);
        }
        
        
        $session->close();
    }
}
