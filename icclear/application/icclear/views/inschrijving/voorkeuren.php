<div class="row">
<h1>Voorkeuren</h1>
<div class="col-md-12">    
    <?php
    $attributes = array('name' => 'myform', 'id' => 'myform');
    echo form_open('voorkeur/doorgeven', $attributes);
    ?>             
    <div class="row">
        <div class="col-md-12">  
            <div class="row">                
                <div class="col-md-12"> 
                    <table class="table">
                        <tr>
                            <th></th>
                            <th>Sessie</th>
                            <th>Omschrijving</th>
                            <th>Spreker</th>
                        </tr>
                        <?php foreach ($sessies as $s) { ?>
                            <tr>
                                <td><?php echo form_checkbox(array('name' => 'gekozensessies[]', 'value' => $s->id)); ?></td>
                                <td><a href="<?php echo base_url(); ?>icclear.php/sessies/toonDetails/<?php echo $s->id; ?>" data-toggle="modal" data-target="#myModal" title="Details" class="glyphicon glyphicon-info-sign link-icon"></a><?php echo $s->onderwerp; ?></td> 
                                <td><?php echo $s->omschrijving; ?></td>                                
                                <td><?php echo $s->spreker->voornaam . " " . $s->spreker->familienaam; ?></td>
                            </tr>
                            <?php } ?>
                    </table>
                </div>
            </div>            
            <input type="hidden" name="gebruiker" value="<?php echo $user->id ?>"/>
            <input type="hidden" name="conferentie" value="<?php echo $conferentieId; ?>"/>
        </div>      
    </div>
    <div class="row">
        <div class="col-md-1"> </div>
        <div class="col-md-3">
            <input type="submit" value="Bevestigen" class="btn btn-default"/>
            <?php echo anchor('home/', 'Annuleer', 'class="btn btn-default"'); ?>
        </div>
    </div>    
    <?php echo form_close(); ?>                                     
</div>
</div>

<!--      Modal voor details       -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content"></div></div>
</div>