<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/2/21
 * Time: 15:58
 */

namespace Common\Model;

use Think\Model;

class BaseModel extends Model {

    const STATUS_DROP = -1;
    const STATUS_DEFAULT = 1;

    public function where($where,$parse=null){
        $tableName = '';
        if($this->options['table']) {
            $optsArr = explode(' ', $this->options['table']);
            $tableName = $optsArr[1].'.';
        };
        if(isset($where[$tableName . 'status'])) {
            $where[$tableName . 'status'] = array(
                $where[$tableName . 'status'],
                array('neq', BaseModel::STATUS_DROP),
                'AND');
        } else {
            $where[$tableName . 'status'] = array('neq', BaseModel::STATUS_DROP);
        }
        parent::where($where, $parse);
        return $this;
    }
}