<?php defined('_JEXEC') or die('Direct Access to this location is not allowed.');
?>

<header class="gkPage">
  <h2>
    <div class="headerBorderRadius">
      <?php echo $this->category->name; ?>
    </div>
  </h2>
</header>

<article class="item-page">

<?php echo $this->loadTemplate('header');

if(count($this->categories)):
  echo $this->loadTemplate('subcategories');
endif;

if(count($this->images)):
  echo $this->loadTemplate('head');
  echo $this->loadTemplate('images');
endif;

echo $this->loadTemplate('footer');
?>

</article>