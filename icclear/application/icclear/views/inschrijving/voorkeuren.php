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
                        <?php
                        $teller = 0;
                        foreach ($programma as $d) {
                            $teller++;
                            ?>
                            <h4>Conferentiedag <?php echo $teller ?> <span class="italic">(<?php echo toDDMMYYYY($d->datum); ?>)</span></h4>
                            <div class="table-responsive space-bottom">
                                <table class = "table-hover table-condensed table">
                                    <thead>
                                        <tr>
                                            <th class="w15">Tijdstip</th>
                                            <th class="w65">Onderwerp</th>                                                                                                                
                                            <th class="w20">Spreker</th>
                                        </tr>
                                    </thead>  
                                    <tbody>                        
                                        <?php foreach ($d->programma as $p) { ?>                             
                                            <tr class="under-link">
                                                <td>
                                                  <?php echo form_checkbox(array('name' => 'gekozensessies[]', 'value' => $p->sessie->id)); ?>  
                                                </td>
                                                <td>
                                                    <p>
                                                        <span class="label label-warning">
                                                            <span aria-hidden="true" class="glyphicon glyphicon-time"></span> <?php echo $p->beginUur . ' - ' . $p->eindUur ?>
                                                        </span>
                                                    </p>
                                                </td> 
                                                <td>
                                                    <a href="<?php echo base_url(); ?>icclear.php/sessies/toonDetails/<?php echo $p->sessie->id; ?>" data-toggle="modal" data-target="#myModal" title="Details" class="">
                                                        <span class="glyphicon glyphicon-info-sign link-icon"></span> <?php echo $p->sessie->onderwerp ?>
                                                    </a>
                                                </td>                                    
                                                <td>
                                                    <a href="" data-toggle="modal" class="toonSpreker" data-id="<?php echo $p->sessie->gebruikerIdSpreker ?>"> 
                                                        <span class="glyphicon glyphicon-user link-icon"></span> <?php echo $p->sessie->spreker->voornaam . ' ' . $p->sessie->spreker->familienaam ?>
                                                    </a>
                                                </td>
                                            </tr> 
                                        <?php } ?>
                                    </tbody>
                                </table>   
                            </div>
                        <?php } ?>

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