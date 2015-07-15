<?php if (property_exists($this->item, 'fields')) : ?>
<div class="event-fields">  
    <div class="field <?php echo $name; ?>">
        <?php echo $this->item->fields->description; ?>
    </div>
</div>
<?php else: ?>
<p>Нет информации о событии</p>
<?php endif; ?>