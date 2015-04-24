<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
        <title></title>
        
        <script type="text/javascript">
            $(document).ready(function () {
                $('.table').DataTable();
            });
        </script>
    </head>
    <body>

        <?php foreach ($dagen as $dag) { ?>
            <h3><?php echo toDDMMYYYY($dag->datum) ?></h3>
            <table class="table table-beheer">
                <thead>
                    <tr>

                        <th>Tijdstip</th>
                        <th>Sessie</th>                
                        <th>Plaats</th>
                        <th>Plenair</th>
                        <th>Beheer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($dag->planning as $planning) { ?>
                        <tr>
                            <td><?php echo $planning->beginUur . " tot " . $planning->eindUur ?></td>
                            <td><?php echo $planning->sessie->onderwerp ?></td>
                            <td><?php echo $planning->zaal->naam . " (" . $planning->gebouw->naam . ")" ?></td>
                            <?php
                            if ($planning->plenair == 1) {
                                echo '<td>Ja</td>';
                            } else {
                                echo '<td>Nee</td>';
                            }
                            ?>
                            <td>
                                <p>                                        
                                    <button class="wijzigPlanning glyphicon glyphicon-pencil btn btn-primary" data-id="<?php echo $planning->id ?>"></button>
                                    <button class="verwijderPlanning glyphicon glyphicon-remove btn btn-danger" data-id="<?php echo $planning->id ?>"></button> 
                                </p>                                 
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>  
        <?php } ?> 
    </body>
</html>
