<?php

// +----------------------------------------------------------
// | Beershop
// +----------------------------------------------------------
// | Thomas More Kempen - 2 TI - 201x-201x
// +----------------------------------------------------------
// | Bestelling/dialogs
// |
// +----------------------------------------------------------
// | K. Vangeel
// +----------------------------------------------------------

?>

<script type="text/javascript">

    var dialogmagtoe = false;
    var deleteid = 0;
    var ok = true;

    function maakDeleteClick() {
        $(".delete").click(function(e) {
            e.preventDefault();
            deleteid = $(this).data("id");
            $( "#dialog-delete" ).dialog( "open" );
        });        
    }
    
    function maakDetailClick() {
        $(".detail").click(function(e) {
            e.preventDefault();
            var iddb = $(this).data("id");
            $( "#id" ).val( iddb );
            if (iddb != 0) {
                // gegevens ophalen via ajax (doorgeven van server met json)
                $.ajax({type : "GET",
                    url : site_url + "/bestelling/read",
                    async: false,
                    data : { id : iddb },
                    success : function(result){
                        var jobject = jQuery.parseJSON(result);
                        $( "#naam" ).val(jobject.naam);
                        $( "#email" ).val(jobject.email);
                        $( "#adres" ).val(jobject.adres);
                        $( "#datum" ).val(jobject.datum);
                    }
                });
            } else {
                // bij toevoegen gewoon vakken leeg maken
                $( "#naam" ).val("");
                $( "#email" ).val("");
                $( "#adres" ).val("");
                $( "#datum" ).val("");
            }
            // eventuele fouten van vorig dialoogvenster wegdoen
            $( "#naam" ).removeClass( "ui-state-error" );
            $( "#email" ).removeClass( "ui-state-error" );
            $( "#adres" ).removeClass( "ui-state-error" );
            $( "#datum" ).removeClass( "ui-state-error" );
            // dialoogvenster openen
            $( "#dialog-detail" ).dialog( "open" ); 
        });   
    }

    function validatieOK ()
    {
        // alle validaties nagaan
        ok = true;

        if ($( "#naam" ).val() == "") {
            $( "#naam" ).addClass( "ui-state-error" );
            ok = false;
        } else {
            $( "#naam" ).removeClass( "ui-state-error" );
        }
        if ($( "#email" ).val() == "") {
            $( "#email" ).addClass( "ui-state-error" );
            ok = false;
        } else {
            $( "#email" ).removeClass( "ui-state-error" );
        }
        if ($( "#adres" ).val() == "") {
            $( "#adres" ).addClass( "ui-state-error" );
            ok = false;
        } else {
            $( "#adres" ).removeClass( "ui-state-error" );
        }
        if ($( "#datum" ).val() == "") {
            $( "#datum" ).addClass( "ui-state-error" );
            ok = false;
        } else {
            $( "#datum" ).removeClass( "ui-state-error" );
        }

        return ok;
    }
            
    $(function(){
        $( "#dialog:ui-dialog" ).dialog( "destroy" );
        $( "#datum" ).datepicker({ dateFormat: 'dd/mm/yy' });

        maakDetailClick();
        maakDeleteClick();

        $( "#dialog-detail" ).dialog({
            autoOpen: false,
            height: 220,
            width: 440,
            modal: true,
            open: function() {
                dialogmagtoe = false;
            },
            buttons: {
                "OK": function() {
                    if (validatieOK()) {
                        // gegevens wegschrijven via ajax (doorgeven naar server via json)
                        var dataString = $("#JqAjaxForm:eq(0)").serialize();
                        $.ajax({
                            type: "POST",
                            url: site_url + "/bestelling/update",
                            async: false,
                            data: dataString,
                            dataType: "json"
                        });
                        dialogmagtoe = true;
                        refreshData();
                        $(this).dialog( "close" );
                    }
                }
            },
            beforeClose: function() {
                if (! dialogmagtoe) {
                    $( "#dialog-annuleer" ).dialog( "open" );
                    return false;
                }
            },
            close: function() {
            }
        });

        $( "#dialog-annuleer" ).dialog({
            autoOpen: false,
            resizable: false,
            height:200,
            modal: true,
            buttons: {
                "Ja": function() {
                    dialogmagtoe = true;
                    $( this ).dialog( "close" );
                    $( "#dialog-detail" ).dialog ( "close" );
                },
                "Neen": function() {
                    $( this ).dialog( "close" );
                }
            }
        });

        $( "#dialog-delete-fout" ).dialog({
            autoOpen: false,
            resizable: false,
            width: 400,
            height: 200,
            modal: true,
            buttons: {
                "OK": function() {
                    $( this ).dialog( "close" );
                }
            }
        });

        $( "#dialog-delete" ).dialog({
            autoOpen: false,
            resizable: false,
            height: 200,
            modal: true,
            buttons: {
                "Ja": function() {
                    // gegevens verwijderen via ajax
                    $.ajax({
                        type: "GET",
                        url: site_url + "/bestelling/delete",
                        async: false,
                        data : { id : deleteid },
                        success : function(result){
                            if (result == '0') {
                                // verwijderen is mislukt, foutmelding tonen
                                $( "#dialog-delete-fout" ).dialog( "open" );
                                $( "#dialog-delete" ).dialog( "close" );
                            } else {
                                refreshData();
                                $( "#dialog-delete" ).dialog( "close" );
                            }
                        }
                    });
                },
                "Neen": function() {
                        $( this ).dialog( "close" );
                }
            }
        });
            
    });
    
</script>

<div id="dialog-detail" title="Bestelling">
    <form id="JqAjaxForm">
        <input type="hidden" name="id" id="id" />
        <table>
            <tr><td align="left" width="70px"><?php echo form_label('Klant:', 'naamlabel'); ?></td>
                <td align="left"><?php echo form_input(array('name' => 'naam', 'id' => 'naam', 'size' => '40', 'class' => 'text ui-widget-content')); ?>
                </td></tr>
            <tr><td align="left"><?php echo form_label('Email:', 'emaillabel'); ?></td>
                <td align="left"><?php echo form_input(array('name' => 'email', 'id' => 'email', 'size' => '40', 'class' => 'text ui-widget-content')); ?>
                </td></tr>
            <tr><td align="left"><?php echo form_label('Adres:', 'adreslabel'); ?></td>
                <td align="left">
                    <?php echo form_input(array('name' => 'adres', 'id' => 'adres', 'size' => '40', 'class' => 'text ui-widget-content')); ?>
                </td></tr>
            <tr><td align="left" valign="top"><?php echo form_label('Datum:', 'datumlabel'); ?></td>
                <td align="left">
                    <?php echo form_input(array('name' => 'datum', 'id' => 'datum', 'size' => '13', 'class' => 'text ui-widget-content')); ?>
                </td></tr>
        </table>
    </form>
</div>

<div id="dialog-annuleer" title="Afsluiten">
	<p><span style="float:left; margin:0 20px 20px 0;"><img src="<?php echo base_url() . APPPATH; ?>images/icons/32x32/warning.png" /></span>
            <span>Eventuele aanpassingen gaan verloren. Ben je zeker?</span>
        </p>
</div>

<div id="dialog-delete" title="Bevestiging">
	<p><span style="float:left; margin:0 20px 20px 0;"><img src="<?php echo base_url() . APPPATH; ?>images/icons/32x32/delete.png" /></span>
            <span>Bestelling wordt verwijderd. Ben je zeker?</span>
        </p>
</div>

<div id="dialog-delete-fout" title="Fout">
	<p><span style="float:left; margin:0 20px 20px 0;"><img src="<?php echo base_url() . APPPATH; ?>images/icons/32x32/delete.png" /></span>
            <span>Je kan deze bestelling niet verwijderen.<br />Aan deze bestelling zijn nog bestellijnen gekoppeld.</span>
        </p>
</div>