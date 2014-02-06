<?php
class Provider extends AppModel 
{

        public function beforeSave($options = [])
        {
                $this->data[$this->alias]['created_at'] = $this->data[$this->alias]['updated_at'] 
                = date('Y-m-d H:i:s');
        }

}
