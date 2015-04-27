

<div class="col-md-10">        
    <h1>Admin dashboard</h1>      

    <h3 style="font-style: italic; margin-left: 25px;"><b>Huidige</b></h3>
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

    <h3 style="font-style: italic; margin-left: 25px;">Aankomende</h3>
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
    
    <h3 style="font-style: italic; margin-left: 25px;">Verleden</h3>
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


<?php echo anchor('conferentie/toevoegen', 'Nieuwe conferentie toevoegen', 'class="btn btn-default"'); ?>  


<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingOne">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          Collapsible Group Item #1
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingTwo">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
          Collapsible Group Item #2
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
          Collapsible Group Item #3
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
      </div>
    </div>
  </div>
</div>
    
</div>

