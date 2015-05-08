
<div class="row">
    <div class="col-md-10"> 

        <h2><?php echo $conferentie->naam ?></h2>
        <h4><?php echo $conferentie->land->naam ?></h4>

        <?php
        $attributes = array('name' => 'myform', 'id' => 'myform', 'method' => 'post');
        echo form_open('gebouw/gebouwPerDagOpslaan', $attributes);
        ?>

        <table class="table table-beheer">
            <thead>
                <tr>
                    <th>Datum</th>
                    <th>Gebouw</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $teller = 0;
                echo form_hidden('conferentieId', $conferentie->id);
                foreach ($conferentiedagen as $conferentiedag) {
                    $teller++;
                    echo form_hidden('id' . $teller, $conferentiedag->id);
                    ?>                
                    <tr>
                        <td><?php echo $conferentiedag->datum ?></td>
                        <td>
                            <?php
                            $options[0] = '-- Kies een gebouw --';
                            foreach ($gebouwen as $gebouw) {
                                $options[$gebouw->id] = $gebouw->naam;
                            }
                            if ($conferentiedag->gebouwId == null){
                                
                            echo form_dropdown('gebouw' . $teller, $options, 0, 'class="form-control"');
                            } else {
                                
                            echo form_dropdown('gebouw' . $teller, $options, $conferentiedag->gebouwId, 'class="form-control"');
                            }
                            ?>
                        </td>
                    </tr>
                <?php }
                echo form_hidden('aantal', $teller)
                ?>
            </tbody>
        </table>  
        <?php echo anchor('admin/dashboard/' . $conferentieId, 'Annuleren', 'class="btn btn-default"'); ?>
        <?php echo form_submit('gebouw/gebouwPerDagOpslaan', 'Opslaan', 'class="btn btn-primary"'); ?>
<?php echo form_close(); ?>
    </div>
</div>
