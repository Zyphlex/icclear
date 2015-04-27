

<div class="col-md-10">        
    <h1>Admin dashboard</h1>      
    <div class="accordion" id="accordion2">
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
                    Collapsible Group Item #1

                    <h3 style="font-style: italic; margin-left: 25px;"><b>Huidige</b></h3>
                </a>
            </div>
            <div id="collapseOne" class="accordion-body collapse in">
                <div class="accordion-inner">
                    <table class="table" style="margin-left: 50px">
                        <thead>
                            <tr>
                                <th>Naam</th>
                                <th>Stad</th>
                                <th>Begindatum</th>
                                <th>Einddatum</th>
                                <th>Beheer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="width:250px"><?php echo $conferentie->naam ?></td>
                                <td style="width:200px"><?php echo $conferentie->stad ?></td>
                                <td style="width:200px"><?php echo toDDMMYYYY($conferentie->beginDatum) ?></td>
                                <td style="width:200px"><?php echo toDDMMYYYY($conferentie->eindDatum) ?></td>
                                <td style="width:150px"><?php echo anchor('admin/dashboard/' . $conferentie->id, 'Beheren', 'class="btn btn-default"'); ?></td>
                            </tr>

                        </tbody>
                    </table>

                </div>
            </div>
        </div>
        <div class="accordion-group">
            <div class="accordion-heading">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">

                    <h3 style="font-style: italic; margin-left: 25px;">Aankomende</h3>
                </a>
            </div>

            <table class="table" style="margin-left: 50px">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Stad</th>
                        <th>Begindatum</th>
                        <th>Einddatum</th>
                        <th>Beheer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($toekomenden as $toe) { ?>
                        <tr>
                            <td style="width:250px"><?php echo $toe->naam ?></td>
                            <td style="width:200px"><?php echo $toe->stad ?></td>
                            <td style="width:200px"><?php echo toDDMMYYYY($toe->beginDatum) ?></td>
                            <td style="width:200px"><?php echo toDDMMYYYY($conferentie->eindDatum) ?></td>
                            <td style="width:150px"><?php echo anchor('admin/dashboard/' . $toe->id, 'Beheren', 'class="btn btn-default"'); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>


        </div>
    </div>
</div>
<div class="accordion-group">
    <div class="accordion-heading">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">

            <h3 style="font-style: italic; margin-left: 25px;">Verleden</h3>
        </a>
    </div>

    <table class="table" style="margin-left: 50px">
        <thead>
            <tr>
                <th>Naam</th>
                <th>Stad</th>
                <th>Begindatum</th>
                <th>Einddatum</th>
                <th>Beheer</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($verleden as $ver) { ?>
                <tr>
                    <td style="width:150px"><?php echo $ver->naam ?></td>
                    <td style="width:130px"><?php echo $ver->stad ?></td>
                    <td style="width:130px"><?php echo toDDMMYYYY($ver->beginDatum) ?></td>
                    <td style="width:130px"><?php echo toDDMMYYYY($ver->eindDatum) ?></td>
                    <td style="width:100px"><?php echo anchor('admin/dashboard/' . $ver->id, 'Beheren', 'class="btn btn-default"'); ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>
</div>
</div>

<?php echo anchor('conferentie/toevoegen', 'Nieuwe conferentie toevoegen', 'class="btn btn-default"'); ?>  


</div>
