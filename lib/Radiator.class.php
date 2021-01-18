<?php
class Radiator 
{
    public function render()
    {
        return '<div class="card border-dark">
              <div class="card-header"> <h3><i class="fab fa-hotjar"></i> Radiateurs</h3></div>
              <div class="card-body text-dark">
                  <ul class="list-group list-group-flush text-center">
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="width: 100%">
                          <button type="button" class="btn btn-light" disabled><i class="fas fa-home fa-3x"></i></button>
                          <button type="button" class="btn btn-primary" data-form="all-hg"><i class="fas fa-snowflake fa-3x"></i></button>
                          <button type="button" class="btn btn-success" data-form="all-eco"><i class="fas fa-temperature-low fa-3x "></i></button>
                          <button type="button" class="btn btn-warning" data-form="all-con"><i class="fas fa-temperature-high fa-3x"></i></button>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="width: 100%">
                          <button type="button" class="btn btn-light" disabled><h5><i class="fas fa-utensils"></i> Salon (22,2 °)</h5></button>
                          <button type="button" class="btn btn-primary" data-form="salon-hg"><i class="fas fa-snowflake fa-3x"></i></button>
                          <button type="button" class="btn btn-success" data-form="salon-eco"><i class="fas fa-temperature-low fa-3x "></i></button>
                          <button type="button" class="btn btn-warning" data-form="all-con"><i class="fas fa-temperature-high fa-3x"></i></button>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="width: 100%">
                          <button type="button" class="btn btn-light" disabled><h5><i class="fas fa-desktop"></i> Bureau (22,2 °)</h5></button>
                          <button type="button" class="btn btn-primary" data-form="bureau-hg"><i class="fas fa-snowflake fa-3x"></i></button>
                          <button type="button" class="btn btn-success" data-form="bureau-eco"><i class="fas fa-temperature-low fa-3x "></i></button>
                          <button type="button" class="btn btn-warning" data-form="bureau-con"><i class="fas fa-temperature-high fa-3x"></i></button>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="width: 100%">
                          <button type="button" class="btn btn-light" disabled><h5><i class="fas fa-door-closed"></i> Entrée (22,2°)</h5></button>
                          <button type="button" class="btn btn-primary" data-form="entree-hg"><i class="fas fa-snowflake fa-3x"></i></button>
                          <button type="button" class="btn btn-success" data-form="entree-eco"><i class="fas fa-temperature-low fa-3x "></i></button>
                          <button type="button" class="btn btn-warning" data-form="entree-con"><i class="fas fa-temperature-high fa-3x"></i></button>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="width: 100%">
                          <button type="button" class="btn btn-light" disabled><h5><i class="fas fa-book"></i> Dégagement (22,2°)</h5></button>
                          <button type="button" class="btn btn-primary" data-form="deg-hg"><i class="fas fa-snowflake fa-3x"></i></button>
                          <button type="button" class="btn btn-success" data-form="deg-eco"><i class="fas fa-temperature-low fa-3x "></i></button>
                          <button type="button" class="btn btn-warning" data-form="deg-con"><i class="fas fa-temperature-high fa-3x"></i></button>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="width: 100%">
                          <button type="button" class="btn btn-light" disabled><h5><i class="fas fa-bed"></i> Parent (22,2°)</h5></button>
                          <button type="button" class="btn btn-primary" data-form="chbp-hg"><i class="fas fa-snowflake fa-3x"></i></button>
                          <button type="button" class="btn btn-success" data-form="chbp-eco"><i class="fas fa-temperature-low fa-3x "></i></button>
                          <button type="button" class="btn btn-warning" data-form="chbp-con"><i class="fas fa-temperature-high fa-3x"></i></button>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="width: 100%">
                          <button type="button" class="btn btn-light" disabled><h5><i class="fas fa-bed"></i> Hugo (22,2°)</h5></button>
                          <button type="button" class="btn btn-primary" data-form="chbh-hg"><i class="fas fa-snowflake fa-3x"></i></button>
                          <button type="button" class="btn btn-success" data-form="chbh-eco"><i class="fas fa-temperature-low fa-3x "></i></button>
                          <button type="button" class="btn btn-warning" data-form="chbh-con"><i class="fas fa-temperature-high fa-3x"></i></button>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="width: 100%">
                          <button type="button" class="btn btn-light" disabled><h5><i class="fas fa-bed"></i> Emilie (22,2°)</h5></button>
                          <button type="button" class="btn btn-primary" data-form="chbe-hg"><i class="fas fa-snowflake fa-3x"></i></button>
                          <button type="button" class="btn btn-success" data-form="chbe-eco"><i class="fas fa-temperature-low fa-3x "></i></button>
                          <button type="button" class="btn btn-warning" data-form="chbe-con"><i class="fas fa-temperature-high fa-3x"></i></button>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="width: 100%">
                          <button type="button" class="btn btn-light" disabled><h5><i class="fas fa-shower"></i> Salle de douche (22,2°)</h5></button>
                          <button type="button" class="btn btn-primary" data-form="sdd-hg"><i class="fas fa-snowflake fa-3x"></i></button>
                          <button type="button" class="btn btn-success" data-form="sdd-eco"><i class="fas fa-temperature-low fa-3x "></i></button>
                          <button type="button" class="btn btn-warning" data-form="sdd-con"><i class="fas fa-temperature-high fa-3x"></i></button>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="width: 100%">
                          <button type="button" class="btn btn-light" disabled><h5><i class="fas fa-bath"></i> Salle de Bain (22,2°)</h5></button>
                          <button type="button" class="btn btn-primary" data-form="sdb-hg"><i class="fas fa-snowflake fa-3x"></i></button>
                          <button type="button" class="btn btn-success" data-form="sdb-eco"><i class="fas fa-temperature-low fa-3x "></i></button>
                          <button type="button" class="btn btn-warning" data-form="sdb-con"><i class="fas fa-temperature-high fa-3x"></i></button>
                        </div>
                      </li>
                  </ul>
              </div>';
    }
}