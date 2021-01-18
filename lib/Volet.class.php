<?php 
class Volet 
{
    public function render()
    {
        return '<div class="card border-dark">
              <div class="card-header"> <h3><i class="fab fa-windows"></i> Volets Roulants</h3></div>
              <div class="card-body text-dark">
                    <ul class="list-group list-group-flush text-center">
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                          <button type="button" class="btn btn-success" data-form="bas-open">Ouverture des volets du bas</button>
                          <button type="button" class="btn btn-danger" data-form="bas-close">Fermeture des volets du bas</button>
                        </div>
                      </li>
                      <li class="list-group-item">
                        <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                          <button type="button" class="btn btn-success" data-form="haut-open">Ouverture des volets du haut</button>
                          <button type="button" class="btn btn-danger" data-form="haut-open">Fermeture des volets du haut</button>
                        </div>
                      </li>
                  </ul>
              </div>
          </div>';
    }
}