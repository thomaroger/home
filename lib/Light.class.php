<?php

class Light 
{
    public function render()
    {
        return '<div class="card border-dark">
              <div class="card-header"> <h3><i class="fas fa-lightbulb"></i> Lumière</h3></div>
              <div class="card-body text-dark">
                    <ul class="list-group list-group-flush text-center">
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                          <button type="button" class="btn btn-success" data-form="bas-light-on">Allumer les lumières du bas</button>
                          <button type="button" class="btn btn-danger" data-form="bas-light-off">Eteindre es lumières du bas</button>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                          <button type="button" class="btn btn-success" data-form="haut-light-on">Allumer les lumières du haut</button>
                          <button type="button" class="btn btn-danger" data-form="haut-light-off">Eteindre les lumières du haut</button>
                        </div>
                      </li>
                  </ul>
                  <ul class="list-group list-group-flush text-center">
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="width: 100%">
                          <button type="button" class="btn btn-light" disabled><h5><i class="fas fa-utensils"></i> Salon</h5></button>
                          <button type="button" class="btn btn-success" data-form="salon-light-on">
                            <i class="far fa-lightbulb fa-3x"></i>
                          </button>
                           <button type="button" class="btn btn-danger" data-form="salon-light-off">
                            <i class="fas fa-power-off fa-3x"></i>
                          </button>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="width: 100%">
                          <button type="button" class="btn btn-light" disabled><h5><i class="fas fa-desktop"></i> Bureau</h5></button>
                         <button type="button" class="btn btn-success" data-form="desk-light-on">
                            <i class="far fa-lightbulb fa-3x"></i>
                          </button>
                           <button type="button" class="btn btn-danger" data-form="desk-light-off">
                            <i class="fas fa-power-off fa-3x"></i>
                          </button>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="width: 100%">
                          <button type="button" class="btn btn-light" disabled><h5><i class="fas fa-door-closed"></i> Entrée</h5></button>
                          <button type="button" class="btn btn-success" data-form="door-light-on">
                            <i class="far fa-lightbulb fa-3x"></i>
                          </button>
                           <button type="button" class="btn btn-danger" data-form="door-light-off">
                            <i class="fas fa-power-off fa-3x"></i>
                          </button>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="width: 100%">
                          <button type="button" class="btn btn-light" disabled><h5><i class="fas fa-book"></i> Dégagement</h5></button>
                          <button type="button" class="btn btn-success" data-form="deg-light-on">
                            <i class="far fa-lightbulb fa-3x"></i>
                          </button>
                           <button type="button" class="btn btn-danger" data-form="deg-light-off">
                            <i class="fas fa-power-off fa-3x"></i>
                          </button>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="width: 100%">
                          <button type="button" class="btn btn-light" disabled><h5><i class="fas fa-bed"></i> Parent</h5></button>
                          <button type="button" class="btn btn-success" data-form="chbp-light-on">
                            <i class="far fa-lightbulb fa-3x"></i>
                          </button>
                           <button type="button" class="btn btn-danger" data-form="chbp-light-off">
                            <i class="fas fa-power-off fa-3x"></i>
                          </button>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="width: 100%">
                          <button type="button" class="btn btn-light" disabled><h5><i class="fas fa-bed"></i> Hugo</h5></button>
                          <button type="button" class="btn btn-success" data-form="chbh-light-on">
                            <i class="far fa-lightbulb fa-3x"></i>
                          </button>
                           <button type="button" class="btn btn-danger" data-form="chbh-light-off">
                            <i class="fas fa-power-off fa-3x"></i>
                          </button>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="width: 100%">
                          <button type="button" class="btn btn-light" disabled><h5><i class="fas fa-bed"></i> Emilie</h5></button>
                           <button type="button" class="btn btn-success" data-form="chbe-light-on">
                            <i class="far fa-lightbulb fa-3x"></i>
                          </button>
                           <button type="button" class="btn btn-danger" data-form="chbe-light-off">
                            <i class="fas fa-power-off fa-3x"></i>
                          </button>                        
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="width: 100%">
                          <button type="button" class="btn btn-light" disabled><h5><i class="fas fa-shower"></i> Salle de douche</h5></button>
                           <button type="button" class="btn btn-success" data-form="sdd-light-on">
                            <i class="far fa-lightbulb fa-3x"></i>
                          </button>
                           <button type="button" class="btn btn-danger" data-form="sdd-light-off">
                            <i class="fas fa-power-off fa-3x"></i>
                          </button> 
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="width: 100%">
                          <button type="button" class="btn btn-light" disabled><h5><i class="fas fa-bath"></i> Salle de Bain</h5></button>
                          <button type="button" class="btn btn-success" data-form="sdb-light-on">
                            <i class="far fa-lightbulb fa-3x"></i>
                          </button>
                           <button type="button" class="btn btn-danger" data-form="sdb-light-off">
                            <i class="fas fa-power-off fa-3x"></i>
                          </button> 
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example" style="width: 100%">
                          <button type="button" class="btn btn-light" disabled><h5><i class="fas fa-toilet"></i> WC</h5></button>
                          <button type="button" class="btn btn-success" data-form="wc-light-on">
                            <i class="far fa-lightbulb fa-3x"></i>
                          </button>
                          <button type="button" class="btn btn-danger" data-form="wc-light-off">
                            <i class="fas fa-power-off fa-3x"></i>
                          </button> 
                        </div>
                      </li>
                  </ul>
              </div>
          </div>';
    }
}