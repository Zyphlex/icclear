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
        <div class="col-md-10"> 
            <?php foreach ($dagen as $dag) { ?>
                <h3><?php echo toDDMMYYYY($dag->datum) ?></h3>
            </div>

            <div class="col-md-10"> 
                <table class="table table-beheer">
                    <thead>
                        <tr>

                            <th>Naam</th>
                            <th>Gemeente</th>                
                            <th>Postcode</th>
                            <th>Land</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dag->planning as $planning) { ?>
                            <tr>
                                <td><?php echo $planning->gebouw->naam ?></td>
                                <td><?php echo $planning->gebouw->gemeente ?></td>
                                <td><?php echo $planning->gebouw->postcode ?></td>
                                <td><?php echo $planning->land->naam ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>  
            </div>
        <?php } ?> 
    </body>
</html>
