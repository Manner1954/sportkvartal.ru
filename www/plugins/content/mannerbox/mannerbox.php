<?php 
 
 defined('_JEXEC') or die;


// Import library dependencies
jimport('joomla.plugin.plugin');
jimport('joomla.utilities.string');


 class plgContentMannerBox extends JPlugin {

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


    // public function onPrepareContent(&$article, &$params, $limitstart = 0)
    // {
    //     $article->text = $this->prepare($article->text);
    // }

    public function onContentPrepare($context, &$article, &$params, $page = 0)
    {
        // // Danger, Will Robinson! $row in Joomla! 1.6/1.7 may be a string, not an article object!
        // if (is_object($row)) {
        //     return $this->onPrepareContent($row, $params, $page);
        // } else {
        //     $row = $this->prepare($row);
        // }

        // return true;
        
        $this->livepath = JURI::getInstance()->root(true);

        $document = JFactory::getDocument(); // set document
        
        $document->addScript($this->livepath . '/jquery-1.9.1.min.js');

        $document->addScript($this->livepath . '/plugins/content/' . $this->_name . '/js/box.js');

        $regex = "#\{mannerbox url=(\"([^\"]+)\"*) count=([0-9]?)}(.*?)\{/mannerbox}#si";  //(\/.+?\.[(png|jpg)]{1,})}*/i   ([0-9a-fA-F]{3,6})    //([_0-9A-Za-zА-яа-яЁё](.*?))color=/^#(?:(?:[a-fd]{3}){1,2})$/i 
        
        $article->text = preg_replace_callback($regex, array($this, 'replacer'), $article->text);
    }



    // private function prepare($text)
    // {
    //     $this->livepath = JURI::getInstance()->root(true);

    //     $document = JFactory::getDocument(); // set document
        
    //     $document->addScript($this->livepath . '/plugins/content/' . $this->_name . '/js/beauty_spa.js');
    //     //$document->addScript(JURI::base().'components/com_mannerfolio/assets/js/jquery.min.js');
    //     $regex = "#{mannerbox color=([0-9a-fA-F]{3,6})}(.*?){/mannerbox}#s";  //([0-9a-fA-F]{3,6})    //([_0-9A-Za-zА-яа-яЁё](.*?))color=/^#(?:(?:[a-fd]{3}){1,2})$/i 
        
    //     $text = preg_replace_callback($regex, array($this, 'replacer'), $text);
        
    //     return $text;
    // }


 	private function replacer(&$matches) {        //stop();

        $html = '';
        $regex1 = "#\{mannerbox url=(\"([^\"]+)\"*) count=([0-9]?)}#si"; // ([0-9a-fA-F]{3,6})}#s        //color=/^#(?:(?:[a-fd]{3}){1,2})$/i
        $regex2 = "#\{/mannerbox}#si";
        $spoilertext = preg_replace($regex2, '', (preg_replace($regex1, '', $matches[0])));
        //var_dump($matches[3]);
        //stop();
        $urlimg = "../".$matches[2];
        $count = intval($matches[3]);
        //var_dump($count);
        
        $document = JFactory::getDocument(); // set document
      
        $script = "<!-- 
                        jQuery(document).ready(function($) {
                             $('.mannerbox').MannerBox(); 
                    }); 
                    // -->
                ";
        
        $document->addScriptDeclaration(trim($script));
   

        $tmpl = '';
        
        if (!$layoutpath_view = $this->getLayoutPath('view')) return false;
        
        ob_start();
            require($layoutpath_view);
            $tmpl .= trim(ob_get_contents());
        ob_end_clean();
        
        return $tmpl;
    }
    
    /**
     * Get Layout
     * 
     * @param $file
     * @return string
     */
    private function getLayoutPath($file = '')
    {
        if (!$file) return false;
        
        $filepath = dirname(__FILE__) . DS . 'tmpl' . DS . $file . '.php';
        if (!JFile::exists($filepath)) return false;
        
        return $filepath;
    }

 }