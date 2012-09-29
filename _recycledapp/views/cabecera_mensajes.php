<div id="messages">
    
    <div class="message ui-state-highlight ui-corner-all ui-helper-clearfix"
         <?php if (!$info) : ?>
            style="display: none;"
         <?php endif;  ?>            
    >
        <?php echo $info ?>
    </div>
    
    
    <div class="message ui-state-error ui-corner-all ui-helper-clearfix"
         <?php if (!$error) : ?>
            style="display: none;"
         <?php endif;  ?>            
    >                        
        <?php echo $error ?>
    </div>
    
</div>