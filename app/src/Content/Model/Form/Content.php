<?php

namespace Content\Model\Form;

use Fonto\Core\FormModel\Base;

class Content extends Base
{
    /**
     * Validation rules and messages for content form
     *
     * @return array
     */
    public function rules()
    {
        return array(
            'title' => array(
                'rules' => 'required|max{32}|min{2}',
            ),
            'data' => array(
                'rules' => 'required',
                'messages' => array(
                    'required' => 'you most fill in a value'
                )
            ),
            'type' => array(
                'rules' => 'required|match{post,page}',
                'messages' => array(
                    'match' => 'wrong type, please use, post or page'
                )
            ),
            'filter' => array(
                'rules' => 'required|match{plain,purifier,bbcode}',
                'messages' => array(
                    'match' => 'wrong type, please use, purifier, bbcode or plain'
                )
            )
        );
    }
}