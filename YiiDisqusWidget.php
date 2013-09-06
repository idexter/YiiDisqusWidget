<?php
/**
* Widget for insert Disqus code in to page.
*
* @author Anton Kucherov <idexter.ru@gmail.com>
* @link http://idexter.ru/
* @copyright 2013 idexter.ru
*/

class YiiDisqusWidget extends CWidget
{
    public $shortname;
    public $identifier;
    public $title;
    public $url;
    public $category_id;

    public $enableCounter = true;

    public function init()
    {
        parent::init();
        if (empty($this->shortname)) {
            throw new CHttpException(500, Yii::t('YiiDisqusWidget', 'Parameter "disqus_shortname" is not set'));
        }

        if ($this->enableCounter === true) {
            Yii::app()->getClientScript()->registerScriptFile(
                "http://{$this->shortname}.disqus.com/count.js",
                CClientScript::POS_HEAD,
                array('async' => 'true')
            );
        }

        $params = array();
        $params['shortname'] = $this->shortname;
        $params['identifier'] = $this->identifier;
        $params['title'] = $this->title;
        $params['url'] = $this->url;
        $params['category_id'] = $this->category_id;

        $this->render('yiidisqus',$params);
    }
}