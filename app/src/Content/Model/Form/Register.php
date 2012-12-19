<?php

namespace Content\Model\Form;

use Fonto\Core\FormModel\Base;

class Register extends Base
{
    /**
     * Validation rules for the registration form
     *
     * @return array
     */
    public function rules()
    {
        return array(
            'username' => array(
                'rules' => 'required|max{32}|min{2}',
            ),
            'password' => array(
                'rules' => 'required|max{32}|min{8}',
            ),
            'password_repeat' => array(
                'rules' => 'required|identical{password}|max{32}|min{8}',
            ),
            'name' => array(
                'rules' => 'required',
            ),
            'email' => array(
                'rules' => 'email',
            )
        );
    }
}