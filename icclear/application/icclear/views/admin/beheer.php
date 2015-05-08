

<div class="col-md-10">        
    <h1>Admin dashboard</h1>  

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
                <h3 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">

                        <span class="bold">Huidige Conferentie</span>
                    </a>
                </h3>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-beheer">
                            <thead>
                                <tr>
                                    <th class="w25">Naam</th>                                
                                    <th class="w30">Periode</th>
                                    <th class="w15">Stad</th>
                                    <th class="w15">Land</th>
                                    <th class="w15">Beheer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><?php echo $conferentie->naam ?></td>                                
                                    <td><?php echo toDDMMYYYY($conferentie->beginDatum) . " - " . toDDMMYYYY($conferentie->eindDatum) ?></td>
                                    <td><?php echo $conferentie->stad ?></td>
                                    <td><?php echo $conferentie->land->naam ?></td>
                                    <td><?php echo anchor('admin/dashboard/' . $conferentie->id, 'Beheren', 'class="btn btn-default"'); ?></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingTwo">
                <h3 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">

                        <span class="bold">Aankomende Conferenties</span>
                    </a>
                </h3>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-beheer">
                            <thead>
                                <tr>
                                    <th class="w25">Naam</th>                                
                                    <th class="w30">Periode</th>
                                    <th class="w15">Stad</th>
                                    <th class="w15">Land</th>
                                    <th class="w15">Beheer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($toekomenden as $toe) { ?>
                                    <tr>
                                        <td><?php echo $toe->naam ?></td>                                
                                        <td><?php echo toDDMMYYYY($toe->beginDatum) . " - " . toDDMMYYYY($conferentie->eindDatum) ?></td>
                                        <td><?php echo $toe->stad ?></td>
                                        <td><?php echo $toe->land->naam ?></td>
                                        <td><?php echo anchor('admin/dashboard/' . $toe->id, 'Beheren', 'class="btn btn-default"'); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingThree">
                <h3 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">

                        <span class="bold">Verleden Conferenties</span>
                    </a>
                </h3>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-beheer">
                            <thead>
                                <tr>
                                    <th class="w25">Naam</th>                                
                                    <th class="w30">Periode</th>
                                    <th class="w15">Stad</th>
                                    <th class="w15">Land</th>
                                    <th class="w15">Beheer</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($verleden as $ver) { ?>
                                    <tr>
                                        <td><?php echo $ver->naam ?></td>                                
                                        <td><?php echo toDDMMYYYY($ver->beginDatum) . " - " . toDDMMYYYY($conferentie->eindDatum) ?></td>
                                        <td><?php echo $ver->stad ?></td>
                                        <td><?php echo $ver->land->naam ?></td>
                                        <td><?php echo anchor('admin/dashboard/' . $ver->id, 'Beheren', 'class="btn btn-default"'); ?></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php echo anchor('conferentie/toevoegen', 'Nieuwe conferentie toevoegen', 'class="btn btn-default"'); ?>  

</div>

