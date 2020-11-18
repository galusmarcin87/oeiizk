<?php

namespace app\components;

use yii\base\Component;

class GlobalVariable extends Component {

    private $global;
    public function set($key, $value) {
        $this->global[$key] = $value;

        return true;
    }

    public function get($key, $default = false){
        return isset($this->global[$key]) ? $this->global[$key] : $default;
    }

}