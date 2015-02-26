
<div class="col-md-10">

    <div class="row">
        <div class="col-md-12">
            <h1>Activiteit toevoegen</h1>
        </div>
    </div>
    
    <?php
    $attributes = array('name' => 'myform', 'id' => 'myform');
    echo form_open('activiteit/insert', $attributes);
    ?>

    <div class="row">
        <div class="col-md-6">  

            <div class="row">
                <div class="col-md-4">   
                    <?php echo form_label('Naam:', 'naam'); ?>
                </div>

                <div class="col-md-8">
                    <?php echo form_input(array('name' => 'naam', 'id' => 'naam', 'class' => 'form-control', 'required' => 'required')); ?>
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">   
                    <label for="omschrijving">
                        Omschrijving:
                    </label>
                </div>

                <div class="col-md-8">   
                    
                    <textarea cols="5" rows="5" name="omschrijving" class="form-control" required="required" id="omschrijving"></textarea>
                </div>
            </div>

        </div>


        <div class="col-md-6 border-left">      
            <div class="row">
                <div class="col-md-4">   
                    <label for="conferentie">
                        Conferentie:
                    </label>
                </div>

                <div class="col-md-8">   
                    <select class="form-control"  name="land" id="field9" required="required">
                        <?php
                        foreach ($conferenties as $conferentie) {
                            echo '<option value="' . $conferentie->id . '">' .
                            $conferentie->naam
                            . '</option>';
                        }
                        ?>
                    </select>
                </div>



                <div class="row">
                    <div class="col-md-4">   
                        <label for="prijs">
                            Prijs:
                        </label>
                    </div>

                    <div class="col-md-8">   
                        <input type="number" name="prijs" id="prijs" class="form-control" required="required">
                    </div>
                </div>
            </div>
        </div>         

    </div>   

    <?php echo anchor('activiteit/overzicht', 'Annuleer', 'class="btn btn-default"'); ?>
    <?php echo form_submit('toevoegen', 'Toevoegen', 'class="btn btn-default"'); ?>

    <?php echo form_close(); ?>
</div>
