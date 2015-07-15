<?php 
 
 defined('_JEXEC') or die;

 class plgContentMannerDivColor extends JPlugin {

 	public function __construct(& $subject, $config) {
 		parent::__construct($subject, $config);
 		$this->loadLanguage();
 	}

 	/*public function onContentPrepare($context, &$row, &$params, $page = 0) {
 		$canProceed = $context == 'com_content.article';
		if (!$canProceed) {
			return;
		}

		// Expression to search for.
       $regex = "#{divcolor color=/^#(?:(?:[a-fd]{3}){1,2})$/i}(.*?){/divcolor}#s";
       //$text = preg_replace_callback($regex, array($this, 'MannerDivColor_replacer'), $row);
       return true;
 	}*/


    public function onPrepareContent(&$article, &$params, $limitstart = 0)
    {
        $article->text = $this->prepare($article->text);
    }

    public function onContentPrepare($context, &$row, &$params, $page = 0)
    {
        // Danger, Will Robinson! $row in Joomla! 1.6/1.7 may be a string, not an article object!
        if (is_object($row)) {
            return $this->onPrepareContent($row, $params, $page);
        } else {
            $row = $this->prepare($row);
        }

        return true;
    }



    private function prepare($text)
    {
        $regex = "#{divcolor color=([0-9a-fA-F]{3,6})}(.*?){/divcolor}#s";  //([0-9a-fA-F]{3,6})    //([_0-9A-Za-zА-яа-яЁё](.*?))color=/^#(?:(?:[a-fd]{3}){1,2})$/i 
        
        $text = preg_replace_callback($regex, array($this, 'MannerDivColor_replacer'), $text);
        return $text;
    }


 	private function MannerDivColor_replacer(&$matches) {
        $html = '';
        $regex1 = "#{divcolor color=([0-9a-fA-F]{3,6})}#s"; //color=/^#(?:(?:[a-fd]{3}){1,2})$/i
        $regex2 = "#{/divcolor}#s";
        $spoilertext = preg_replace($regex2, '', (preg_replace($regex1, '', $matches[0])));
        $html .= '<div class="mannerdivlines" style="background-color: #'.$matches[1].';">
                    <div class="mannerdivlines-margin">' . $spoilertext . '</div>
                  </div>';
        return $html;
 	}
 }