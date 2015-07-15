<?php

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

$print = JRequest::getCmd('print');

if ($this->grid['cols'])
    $width = round(96 / count($this->grid['cols']));

//print_r($this->items);

?>

<script src="jquery-1.9.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
  $(document).ready(function(){
  $(".CheckBoxClass").change(function(){
    var gr = $(this).attr('id');
    if($(this).is(":checked")){ 
      $('#tab tr td div.'+gr).addClass('check'+gr);
    }else{
      $('#tab tr td div.'+gr).removeClass('check'+gr);
    }
  });

  $("#uncheck_all").click(function () {
          $(".CheckBoxClass").each(function() {
            $('#tab tr td div.' + $(this).attr('id')).removeClass('check' + $(this).attr('id'));
            $(this).removeAttr("checked");
        });
          $(".CheckBoxRecord").each(function() {
            $('#tab tr td div.grouprecord').removeClass('checkgrouprecord');
            $(this).removeAttr("checked");
        });    
  });
   
	$(".CheckBoxRecord").change(function(){
	    if($(this).is(":checked")){ 
	      $('#tab tr td div.grouprecord').addClass('checkgrouprecord');
	    }else{
	      $('#tab tr td div.grouprecord').removeClass('checkgrouprecord');
	    }
	});

  });


</script> 

<div class="gkPage">
  <h2 class="itemTitle"><div class="headerBorderRadius"><?php echo $this->menu->title; ?></<div></div></h2>
</div>
<div class="div_grey">
  <article class="item-page">
      <div class="gkPage">
        <div style="text-align: right; font-weight: 400;">Расписание занятий на <?php echo JHTML::_('date', 'now', JText::_('d F Y')); ?></div>
        <?php if ($print != 1) : ?>
           <div style="float: left; padding-left: 10px; padding-top: 5px;">
            <div style="font-weight: 700; padding-bottom: 5px;">ВИДЫ ТРЕНИРОВОК:</div>
            <?php foreach ($this->groupids as $groupid):?> 
              <div style=" width: 170px; padding-left: 20px; padding-right: 20px; padding-bottom: 5px;">
                <div style="float: left; margin-right: 5px !important;">
                  <input type="checkbox" id="group<?php echo $groupid->id; ?>" name="groupid[]" value="<?php echo $groupid->id; ?>" class="CheckBoxClass" style="display: block;"  />
                </div>
                <div>
                  <?php echo $groupid->title; ?>
                </div>
              </div>
            <?php endforeach; ?>

              <div style=" width: 170px; padding-left: 20px; padding-right: 20px; padding-bottom: 5px;">
                <div style="float: left; margin-right: 5px !important;">
                  <input type="checkbox" id="checkgrouprecord" name="groupid[]" value="999" class="CheckBoxRecord" style="display: block;"  />
                </div>
                <div>
                  По записи
                </div>
              </div>

              <div style=" width: auto; padding-bottom: 5px;">
                  <span id="uncheck_all" class="UnCheckBoxClass" style="display: block; cursor: pointer;" />Снять выделение</span>
              </div>
              <div style="float: left;">
                <div class="print-icon itemPrint">
                <?php //JHtml::_('icon.print_popup',  $this); 
                    $idb = JRequest::getInt('id');
                    if($idb == 1)
                      $paySheduleLink = JRoute::_("index.php?option=com_schedule&amp;view=schedule&amp;id=1&amp;Itemid=106&amp;tmpl=printshedule&amp;print=1&amp;layout=default&amp;page=");
                    else
                      $paySheduleLink = JRoute::_("index.php?option=com_schedule&amp;view=schedule&amp;id=2&amp;Itemid=106&amp;tmpl=printshedule&amp;print=1&amp;layout=default&amp;page=");
                ?>
                <a rel="nofollow" onclick="window.open(this.href,'win2','status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=640,height=480,directories=no,location=no'); 
                        return false;" title="Печать" href="<?php echo $paySheduleLink?>">Печать</a>
                </div>
              </div>
              <?php 
                    //$idb = JRequest::getInt('id');
                    if($idb == 1) 
                    {
              ?>      
                      <div style="clear: both; padding-top: 10px; background-color: rgb(255, 255, 255); border: 2px solid rgb(235, 2, 153); text-align: center; padding-bottom: 10px; margin-right: 30px; margin-top: 30px;">
                        <?php 
                          $paySheduleLink = JRoute::_("index.php?option=com_schedule&view=schedule&id=2");
                          echo("<a href=\"". $paySheduleLink ."\" >ПЛАТНОЕ РАСПИСАНИЕ</a>");
                        ?>
                      </div>

                      <div style="clear: both; padding-top: 10px; background-color: rgb(255, 255, 255); border: 2px solid rgb(235, 2, 153); text-align: center; padding-bottom: 10px; margin-right: 30px; margin-top: 30px;">
                        <?php 
                          $paySheduleLink = JRoute::_("index.php?option=com_schedule&view=schedule&id=3");
                          echo("<a href=\"". $paySheduleLink ."\" >12 июня 2015</a>");
                        ?>
                      </div>

                      <!--<div style="clear: both; padding-top: 10px; background-color: rgb(255, 255, 255); border: 2px solid rgb(235, 2, 153); text-align: center; padding-bottom: 10px; margin-right: 30px; margin-top: 30px;">
                        <?php 
                          $paySheduleLink = JRoute::_("index.php?option=com_schedule&view=schedule&id=4");
                          echo("<a href=\"". $paySheduleLink ."\" >4-10 мая 2015</a>");
                        ?>
                      </div> -->
                      
              <?php
                    }
                    else
                    {
              ?>
                      <div style="clear: both; padding-top: 10px; background-color: rgb(255, 255, 255); border: 2px solid rgb(235, 2, 153); text-align: center; padding-bottom: 10px; margin-right: 30px; margin-top: 30px;">
                        <?php 
                          $paySheduleLink = JRoute::_("index.php?option=com_schedule&view=schedule&id=1");
                          echo("<a href=\"". $paySheduleLink ."\" >Назад</a>");
                        ?>
                      </div>
              <?php } ?>

          </div>
        <?php endif; ?>  
        <div class="div_shedule gkPage">
          <table id="tab" class="table table-shedule">
              <thead class="shedule_days_week">
                  <tr id="tabtr">
                      <td width="4%"></td>              
                      <?php foreach($this->grid['cols'] as $col): ?>
                      <td  class="backgroundth" width="<?php echo $width; ?>%"><?php echo $col->title; ?></td>
                      <?php endforeach; ?>
                  </tr>
              </thead>
              <tbody>
                  <?php 
                      $rowsCount = 0;
                      foreach($this->grid['rows'] as $row): 
                        $rowsCount++;
                        $colVisible = 0;

                        foreach($this->grid['cols'] as $col):
                            if (isset($this->items[$row->id][$col->id])) 
                                $colVisible = 1;
                        endforeach;
                        if($colVisible == 1) :
                  ?>
                          <tr style="height: 100px;" id="<?php echo $rowsCount; ?>" class="onlytablet<?php echo $rowsCount; ?>">
                            <td class="time"><?php echo $this->shotTime($row->line_time); ?></td>
                          <?php
                            foreach($this->grid['cols'] as $col): 
                          ?>
                                      <td class="backgroundt">     
                                      <?php if (isset($this->items[$row->id][$col->id])):
                                          $items = $this->items[$row->id][$col->id];
                                          ?>
                                            <?php
                                            $ci = 0;
                                            foreach($items as $item) {
                                              //echo '<div class="group'.$item->groupid.'">';
                                              printf('<div class="group%s%s">', $item->groupid, $item->record ? " grouprecord" : "");
                                              $ci++;
                                              //$elem = 
                                              //$link = $item->article_id ? JRoute::_('index.php?option=com_content&view=article&id='.$item->article_id) : JRoute::_('index.php?option=com_schedule&view=event&id='. $item->event_id);
                                              $link = JRoute::_('index.php?option=com_schedule&view=event&id='. $item->event_id);
                                              ?>
                                              {tip <?php if (property_exists($item, 'subfields')): ?>
                                                  <p> <?php echo $item->subfields->description; ?> </p>
                                              <?php endif; ?> } 
                                              <a class="title" href="<?php echo $link; ?>"><?php echo $item->title; ?></a>  
                                              {/tip}
                                              <?php if (property_exists($item, 'subfields')): ?>
                                              <div class="subfields">
                                                  <?php echo $item->subfields->trainer; ?>
                                              </div>
                                              <?php if((count($items)>1) && ($ci <= (count($items)-1))) { ?>
                                                <div style="border-bottom: 1px dashed #000000;"> </div>
                                              <?php }
                                              endif; 
                                              echo '</div>';
                                            }?> 

                                          <?php endif; ?>   
                                          </td> 
                          <?php endforeach; ?>
                          </tr>
                        <?php endif;?>      

                      <script type="text/javascript">
                        $(document).ready(function(){
                          var gr = $(this).attr('id');
                          $('table tbody tr.').removeClass("onlytablet"+gr);
                        }
                      </script>
                  <?php endforeach;  ?>
              </tbody>
          </table>
          <p><br />Уровни подготовки привести в соответствии со значками <br />* - класс подходит для всех уровней подготовки. <br />**- класс подходит для среднего уровня подготовки. <br />*** - класс подходит только для подготовленных</p>
        </div>
      </div>
  </article>
</div>