 <?php 
	defined('_JEXEC') or die;

	jimport('joomla.database.table');

	class MannerfolioTableMannerfolio extends JTable
	{
		function __construct(&$db)
		{
			parent::__construct('#__mannerfolio', 'id', $db);
		}

		protected function _getAssetName()
		{
			$k = $this->_tbl_key;

			return 'com_mannerfolio.card.' . (int) $this->$k;
		}

		protected function _getAssetTitle()
		{
			return $this->name;
		}

		protected function _getAssetParentId($table = null, $id = null)
		{
			$assetParent = JTable::getInstance('Asset');
			$assetParentId = $assetParent->getRootId();

			if(($this->catid) && !empty($this->catid))
			{
				$assetParent->loadByName('com_mannerfolio.category' . (int) $this->catid);
			}
			else
			{
				$assetParent->loadByName('com_mannerfolio');
			}

			if($assetParent->id)
			{
				$assetParentId = $assetParent->id;
			}
			return $assetParentId;
		}

		public function publish($pks = null, $state = 1, $userId = 0)
		{
			$k = $this ->_tbl_key;
			// Очищаем входные параметры

			JArrayHelper::toInteger($pks);
			$state = (int) $state;

			if(empty($pks))
			{
				if($this->$k)
				{
					$pks = array($this->$k);
				}
				else
				{
					throw new RuntimeException(JText::_('JLIB_DATABASE_ERROR_NO_ROWS_SELECTED'));
				}
			}

			// Устанавливаем состояние для всех первичных ключей
			foreach ($pks as $pk) 
			{
				if(!$this->load($pk))
				{
					throw new RuntimeException(JText::_('COM_MANNERFOLIO_TABLE_ERROR_RECORD_LOAD'), 500);
				}
			
				$this->state = $state;

				if(!$this->store())
				{
					throw new RuntimeException(JText::_('COM_MANNERFOLIO_TABLE_ERROR_RECORD_STORE'), 500);
					
				}
			}

			return true;
		}
	}