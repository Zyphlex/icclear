<h1>Voorkeuren</h1>
<div class="col-md-10">    
    <?php
    $attributes = array('name' => 'myform', 'id' => 'myform');
    echo form_open('voorkeur/doorgeven', $attributes);
    ?>             
    <div class="row">
        <div class="col-md-6">  
            <div class="row">                
                <div class="col-md-8"> 
                    <table class="table table-bordered">
                        <tr>
                            <th></th>
                            <th>Sessie</th>
                        </tr>
                        <?php
                        foreach ($sessies as $s) {
                            ?>
                        <tr>
                            <td><?php echo form_checkbox(array('name' => 'sessies[]', 'value' => $s->id));?></td>
                            <td><?php echo $s->onderwerp;?></td>                                                                
                        </tr>
                        <?php
                            }
                        ?>
                    </table>
                </div>
            </div>            
            <input type="hidden" name="gebruiker" value="<?php echo $user->id ?>"/>
            <input type="hidden" name="conferentie" value="<?php echo $conferentieId; ?>"/>
        </div>      
    </div>
    <div class="row" style="margin-top: 15px;">
        <div class="col-md-1"> </div>
        <div class="col-md-3">
            <input type="submit" value="Bevestigen" class="btn btn-default"/>
            <?php echo anchor('home/', 'Annuleer', 'class="btn btn-default"'); ?>
        </div>
    </div>    
    <?php echo form_close(); ?>                                     
</div>

