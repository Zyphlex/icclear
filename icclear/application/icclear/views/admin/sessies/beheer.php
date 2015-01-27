<div class="col-md-10">
    <div class="panel panel-default" role="tablist">

        <div class="panel-heading" role="tab" id="collapseListGroupHeading1">
            <h4 class="panel-title">
                <span href="#collapseListGroup1" aria-expanded="false" aria-controls="collapseListGroup1">
                    Sessie
                </span>
            </h4>
        </div>

        <div id="collapseListGroup1"  role="tabpanel" aria-labelledby="collapseListGroupHeading1">
            <div class="panel-body">
                <?php
                $attributes = array('name' => 'myform', 'id' => 'myform');
                echo form_open('gebruiker/registreer', $attributes);
                echo form_hidden('id', $gebruiker->id);
                ?>

                <div class="modal-body">
                    <?php if (isset($sessie)) {?>
                    <p>TEST</p>
                    <?php } else { ?>
                    <?php } ?>
                </div>
                
            </div>

        </div>
    </div>
</div>
