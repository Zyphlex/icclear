<script type="text/javascript">    
    //Gegevens opvragen en tonen
    function haaloverzicht() {
        $.ajax({type: "GET",
            url: site_url + "/sessies/lijst",
            success: function (result) {
                $("#resultaat").html(result);                
                maakDeleteClick();  
                goedkeurenClick();
            }
        });
    }

    //Wijzigen refreshen
    function refreshData() {
        haaloverzicht();
    }

    //Klikken op de Verwijderen knop
    function maakDeleteClick() {
        $(".verwijderVoorstel").click(function () {
            deleteid = $(this).data("id");
            $("#voorstelAfkeuren").modal('show');
        });
    }
    
    function goedkeurenClick() {
        $(".goedVoorstel").click(function () {
            deletedid = $(this).data("id");
            $("#voorstelGoedkeuren").modal('show');
        });
    }
    
    $(document).ready(function () {
        //Link leggen met de knoppen die gemaakt worden in lijst.php        
        maakDeleteClick();
        goedkeurenClick()
        //Lijst eerste maal ophalen en tonen
        haaloverzicht();


        //Klikken op "BEVESTIG" in de Delete modal
        $(".deleteVoorstel").click(function () {
            $.ajax({
                type: "POST",
                url: site_url + "/sessies/afkeuren",
                async: false,
                data: {id: deletedid},
                success: function (result) {
                    if (result == '0') {
                        alert("Er is iets foutgelopen!");
                    } else {
                        refreshData();
                    }
                    $("#voorstelAfkeuren").modal('hide');
                }
            });
        });
        
        $(".goedVoorstel").click(function () {
            $.ajax({
                type: "POST",
                url: site_url + "/sessies/goedkeuren",
                async: false,
                data: {id: deletedid},
                success: function (result) {
                    if (result == '0') {
                        alert("Er is iets foutgelopen!");
                    } else {
                        refreshData();
                    }
                    $("#voorstelGoedkeuren").modal('hide');
                }
            });
        });

    });
</script>
<div class="col-md-10">
    
    <h1>Sessies keuren</h1>
    
    <div id="resultaat"></div>
        
    <?php echo anchor('admin/dashboard/' . $conferentieId, 'Annuleren','class="btn btn-default"'); ?>                           
    <?php echo anchor('sessies', 'Terug naar sessies','class="btn btn-primary"'); ?>                           
                
</div>

<!--      Modal voor details       -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog"><div class="modal-content"></div></div>
</div>

<!-- MODAL VOOR AFKEUREN -->  
<div class="modal fade" id="voorstelAfkeuren" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">OPGELET!</h4>
            </div>

            <div class="modal-body">                  
                <p>Bent u zeker dat u dit voorstel wilt afkeuren (en dus verwijderen)?</p>  
                <p class="italic">Dit kan niet ongedaan gemaakt worden!</p>                  
            </div>

            <div class="modal-footer">
                <button type="button" class="deleteVoorstel btn btn-primary">Bevestig</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div>  

<!-- MODAL VOOR GOEDKEUREN -->  
<div class="modal fade" id="voorstelGoedkeuren" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">OPGELET!</h4>
            </div>

            <div class="modal-body">                  
                <p>Bent u zeker dat u dit voorstel wilt goedkeuren?</p>  
                <p class="italic">Dit kan niet ongedaan gemaakt worden!</p>                  
            </div>

            <div class="modal-footer">
                <button type="button" class="goedVoorstel btn btn-primary">Bevestig</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Annuleren</button>
            </div>

        </div>            
    </div>
</div> 