<script type="text/javascript">
    //Gegevens opvragen en tonen
    function haaloverzicht() {
        $.ajax({type: "GET",
            url: site_url + "/hotels/overzicht",
            success: function(result) {
                $("#resultaat").html(result);
                maakDetailClick();
                maakDeleteClick();
                $('.table').DataTable({
                    "aaSorting": []
                });
            }
        });
    }

    //Wijzigen refreshen
    function refreshData() {
        haaloverzicht();
    }

    //Klikken op de Verwijderen knop
    function maakDeleteClick() {
        $(".verwijderHotel").click(function() {
            deleteid = $(this).data("id");
            $("#hotelDelete").modal('show');
        });
    }

    //Klikken op de Wijzig knop/Toevoeg knop
    function maakDetailClick() {
        $(".wijzigHotel").click(function() {
            var iddb = $(this).data("id");
            $("#id").val(iddb);
            if (iddb != 0) {
                // gegevens ophalen via ajax (doorgeven van server met json)
                $.ajax({type: "GET",
                    url: site_url + "/hotels/detail",
                    async: false,
                    data: {id: iddb},
                    success: function(result) {
                        var jobject = jQuery.parseJSON(result);
                        $("#naam").val(jobject.naam);
                        $("#website").val(jobject.website);
                        $("#straat").val(jobject.straat);
                        $("#nummer").val(jobject.nummer);
                        $("#gemeente").val(jobject.gemeente);
                        $("#postcode").val(jobject.postcode);
                    }
                });
            } else {
                // bij toevoegen gewoon vakken leeg maken
                $("#naam").val("");
                $("#website").val("");
                $("#straat").val("");
                $("#nummer").val("");
                $("#gemeente").val("");
                $("#postcode").val("");
            }
            // dialoogvenster openen
            $("#hotelModal").modal('show');
        });
    }

    $(document).ready(function() {
        //Link leggen met de knoppen die gemaakt worden in lijst.php
        maakDetailClick();
        maakDeleteClick();
        //Lijst eerste maal ophalen en tonen
        haaloverzicht();

        //Klikken op "BEVESTIG" in de Delete modal
        $(".deleteHotel").click(function() {
            $.ajax({
                type: "POST",
                url: site_url + "/hotels/delete",
                async: false,
                data: {id: deleteid},
                success: function(result) {
                    if (result == '0') {
                        alert("Er is iets foutgelopen!");
                    } else {
                        refreshData();
                    }
                    $("#hotelDelete").modal('hide');
                }
            });
        });

    });
</script>


<div class="col-md-10">

    <h1>Hotel beheren</h1>  

    <div id="resultaat"></div>        

    <?php echo anchor('admin', 'Annuleren', 'class="btn btn-default"'); ?>

    <button class="wijzigHotel btn btn-primary" data-id="0">Nieuwe Hotel Toevoegen</button>

</div>


<!-- MODAL VOOR DETAILS -->         
<div class="modal fade" id="hotelModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"></h4>
            </div>

            <div class="modal-body">                  

                <?php
                $attributes = array('id' => 'JqAjaxForm', 'name' => 'JqAjaxForm', 'enctype' => 'multipart/form-data');
                echo form_open('hotels/update', $attributes);
                ?>
                <input type="hidden" name="id" id="id" />
                <p><?php echo form_label('Naam:', 'naam'); ?></p>
                <p><?php echo form_input(array('name' => 'naam', 'id' => 'naam', 'class' => 'form-control')); ?></p>

                <p><?php echo form_label('Website:', 'website'); ?></td>
                <p><?php echo form_textarea(array('name' => 'website', 'id' => 'website', 'class' => 'form-control', 'rows' => '2', 'cols' => '10')); ?></p>

                <p><?php echo form_label('Straat:', 'straat'); ?></p>
                <p><?php echo form_input(array('name' => 'straat', 'id' => 'straat', 'class' => 'form-control')); ?></p>

                <p><?php echo form_label('Nummer:', 'nummer'); ?></p>
                <p><?php echo form_input(array('name' => 'nummer', 'id' => 'nummer', 'class' => 'form-control')); ?></p>

                <p><?php echo form_label('Gemeente:', 'gemeente'); ?></p>
                <p><?php echo form_input(array('name' => 'gemeente', 'id' => 'gemeente', 'class' => 'form-control')); ?></p>

                <p><?php echo form_label('Postcode:', 'postcode'); ?></p>
                <p><?php echo form_input(array('name' => 'postcode', 'id' => 'postcode', 'class' => 'form-control')); ?></p>

                <p><?php echo form_label('Afbeelding:', 'userfile'); ?></p>
                <p><?php echo form_upload(array('name' => 'userfile', 'id' => 'userfile', 'class' => 'form-control')); ?></p>


            </div>

            <div class="modal-footer">
                <?php echo form_submit(array('name' => 'submit', 'id' => 'submit', 'class' => 'opslaanHotel btn btn-primary', 'value' => 'Opslaan')) ?>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>
        <?php echo form_close() ?>
        </div>            
    </div>
</div>  


<!-- MODAL VOOR VERWIJDEREN -->  
<div class="modal fade" id="hotelDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">OPGELET!</h4>
            </div>

            <div class="modal-body">                  
                <p>Bent u zeker dat u deze hotel wilt verwijderen?</p>  
                <p class="italic">Dit kan niet ongedaan gemaakt worden!</p>                  
            </div>

            <div class="modal-footer">
                <button type="button" class="deleteHotel btn btn-primary">Bevestig</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  