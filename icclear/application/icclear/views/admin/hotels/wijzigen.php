
<div class="col-md-10">

    <div class="row">
        <div class="col-md-12">
            <h1>Hotel wijzigen</h1>
        </div>
    </div>
    <?php
    $attributes = array('name' => 'myform', 'id' => 'myform');
    echo form_open('hotels/update', $attributes);
    echo form_hidden('id', $hotel->id);
    ?>

    <div class="row">
        <div class="col-md-6">  

            <div class="row">
                <div class="col-md-4">   
                    <?php echo form_label('Naam:', 'naam'); ?>
                </div>

                <div class="col-md-8">
                    <?php echo form_input(array('name' => 'naam', 'id' => 'naam', 'value' => $hotel->naam, 'class' => 'form-control', 'required' => 'required', 'width' => '10')); ?>
                </div>
            </div>



            <div class="row">
                <div class="col-md-4">   
                    <?php echo form_label('Website:', 'website'); ?>
                </div>

                <div class="col-md-8">
                    <?php echo form_input(array('name' => 'website', 'id' => 'website', 'value' => $hotel->website, 'class' => 'form-control', 'required' => 'required')); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">   
                    <?php echo form_label('Gemeente:', 'gemeente'); ?>
                </div>

                <div class="col-md-8">
                    <?php echo form_input(array('name' => 'gemeente', 'id' => 'gemeente', 'value' => $hotel->gemeente, 'class' => 'form-control', 'required' => 'required')); ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">   
                    <?php echo form_label('Postcode:', 'postcode'); ?>
                </div>

                <div class="col-md-8">
                    <?php echo form_input(array('name' => 'postcode', 'id' => 'postcode', 'value' => $hotel->postcode, 'class' => 'form-control', 'required' => 'required')); ?>
                </div>
            </div>

        </div>


        <div class="col-md-6 border-left">      
            <div class="row">
                <div class="row">
                    <div class="col-md-4">   
                        <?php echo form_label('Straat:', 'straat'); ?>
                    </div>

                    <div class="col-md-8">
                        <?php echo form_input(array('name' => 'straat', 'id' => 'straat', 'value' => $hotel->straat, 'class' => 'form-control', 'required' => 'required')); ?>
                    </div>
                </div>
                
                 <div class="row">
                    <div class="col-md-4">   
                        <?php echo form_label('Nummer:', 'nummer'); ?>
                    </div>

                    <div class="col-md-8">
                        <?php echo form_input(array('name' => 'nummer', 'id' => 'nummer', 'value' => $hotel->nummer, 'class' => 'form-control', 'required' => 'required')); ?>
                    </div>
                </div>

            </div>
        </div>         

    </div>

    <?php echo anchor('hotels/overzicht', 'Annuleer', 'class="btn btn-default"'); ?>
    <?php echo form_submit('opslaan', 'Opslaan', 'class="btn btn-default"'); ?>

    <?php echo form_close(); ?>
</div>
