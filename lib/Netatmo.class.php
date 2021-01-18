<?php 
class Netatmo 
{
    public function render()
    {
        return '
           <div class="card border-dark">
              <div class="card-header">
                  <div class="row">
                    <div class="col-md-9 text-start"><h3><i class="fas fa-umbrella-beach "></i> Extérieur </h3></div>
                    <div class="col-md-3 text-end"><p class="text-muted"> <i class="fas fa-battery-full"></i> 58%</p></div>
                  </div>
              </div>
              <div class="card-body text-dark">
                  <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item"><h3>Température : 22,2° <i class="fas fa-arrow-up"></i> <i class="fas fa-arrow-down"></i></h3></li>
                    <li class="list-group-item">Humidité : 44%</li>
                    <li class="list-group-item">Pression : 1023 Hpa</li>
                  </ul>
              </div>
                <div class="card-footer text-muted">
                  <div class="row">
                  <div class="col-md-6 text-start"><i class="fas fa-temperature-low"></i> 10,3° (12/01/2021 08:52)</div>
                  <div class="col-md-6 text-end"><i class="fas fa-temperature-high"></i> 26,3° (12/01/2021 16:52)</div>
                  </div>
                </div>
            </div>

            <div class="card border-dark">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-9 text-start"><h3><i class="fas fa-utensils"></i> Salon </h3></div>
                    <div class="col-md-3 text-end"><p class="text-muted"> <i class="fas fa-battery-full"></i> 58%</p></div>
                  </div>
                </div>
              <div class="card-body text-dark">
                <div class="row">
                  <div class="col-md-3">
                      <span class="badge rounded-pill bg-danger" style="height: 100%;width: 100%;">
                        <table style="height: 100%;width: 100%;">
                          <tbody>
                            <tr>
                              <td class="align-middle"><h1>1500</h1>ppm</td>
                            </tr>
                          </tbody>
                        </table>
                      </span>
                  </div>
                  <div class="col-md-9">
                    <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item"><h3><i class="fas fa-thermometer-quarter"></i> 22,2° <i class="fas fa-arrow-up"></i> <i class="fas fa-arrow-down"></i></h3></li>
                    <li class="list-group-item">Humidité : 44%</li>
                    <li class="list-group-item">Bruit : 53 dB</li>
                  </ul>
                  </div>
                </div>
                </div>
                <div class="card-footer text-muted">
                  <div class="row">
                  <div class="col-md-6 text-start"><i class="fas fa-temperature-low"></i> 10,3° (12/01/2021 08:52)</div>
                  <div class="col-md-6 text-end"><i class="fas fa-temperature-high"></i> 26,3° (12/01/2021 16:52)</div>
                  </div>
                </div>
            </div>

            <div class="card border-dark">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-9 text-start"><h3><i class="fas fa-desktop"></i> Bureau </h3></div>
                    <div class="col-md-3 text-end"><p class="text-muted"> <i class="fas fa-battery-full"></i> 58%</p></div>
                  </div>
                </div>
              <div class="card-body text-dark">
                <div class="row">
                  <div class="col-md-3">
                      <span class="badge rounded-pill bg-warning" style="height: 100%;width: 100%;">
                        <table style="height: 100%;width: 100%;">
                          <tbody>
                            <tr>
                              <td class="align-middle"><h1>1000</h1>ppm</td>
                            </tr>
                          </tbody>
                        </table>
                      </span>
                  </div>
                  <div class="col-md-9">
                    <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item"><h3><i class="fas fa-thermometer-quarter"></i> 22,2° <i class="fas fa-arrow-up"></i> <i class="fas fa-arrow-down"></i></h3></li>
                    <li class="list-group-item">Humidité : 44%</li>
                  </ul>
                  </div>
                </div>
                </div>
                <div class="card-footer text-muted">
                  <div class="row">
                    <div class="col-md-6 text-start"><i class="fas fa-temperature-low"></i> 10,3° (12/01/2021 08:52)</div>
                    <div class="col-md-6 text-end"><i class="fas fa-temperature-high"></i> 26,3° (12/01/2021 16:52)</div>
                  </div>
                </div>
            </div>

            <div class="card border-dark">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-9 text-start"><h3><i class="fas fa-bed"></i> Chambre </h3></div>
                    <div class="col-md-3 text-end"><p class="text-muted"> <i class="fas fa-battery-full"></i> 58%</p></div>
                  </div>
                </div>
              <div class="card-body text-dark">
                <div class="row">
                  <div class="col-md-3">
                      <span class="badge rounded-pill bg-success" style="height: 100%;width: 100%;">
                        <table style="height: 100%;width: 100%;">
                          <tbody>
                            <tr>
                              <td class="align-middle"><h1>800</h1>ppm</td>
                            </tr>
                          </tbody>
                        </table>
                      </span>
                  </div>
                  <div class="col-md-9">
                    <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item"><h3><i class="fas fa-thermometer-quarter"></i> 22,2° <i class="fas fa-arrow-up"></i> <i class="fas fa-arrow-down"></i></h3></li>
                    <li class="list-group-item">Humidité : 44%</li>
                  </ul>
                  </div>
                </div>
                </div>
                <div class="card-footer text-muted">
                  <div class="row">
                  <div class="col-md-6 text-start"><i class="fas fa-temperature-low"></i> 10,3° (12/01/2021 08:52)</div>
                  <div class="col-md-6 text-end"><i class="fas fa-temperature-high"></i> 26,3° (12/01/2021 16:52)</div>
                  </div>
                </div>
            </div>

            <div class="card border-dark">
              <div class="card-header">
                <div class="row">
                    <div class="col-md-9 text-start"><h3><i class="fas fa-book"></i> Dégagement </h3></div>
                    <div class="col-md-3 text-end"><p class="text-muted"> <i class="fas fa-battery-full"></i> 58%</p></div>
                  </div>
                </div>
              <div class="card-body text-dark">
                <div class="row">
                  <div class="col-md-3">
                      <span class="badge rounded-pill bg-success" style="height: 100%;width: 100%;">
                        <table style="height: 100%;width: 100%;">
                          <tbody>
                            <tr>
                              <td class="align-middle"><h1>800</h1>ppm</td>
                            </tr>
                          </tbody>
                        </table>
                      </span>
                  </div>
                  <div class="col-md-9">
                    <ul class="list-group list-group-flush text-center">
                    <li class="list-group-item"><h3><i class="fas fa-thermometer-quarter"></i> 22,2° <i class="fas fa-arrow-up"></i> <i class="fas fa-arrow-down"></i></h3></li>
                    <li class="list-group-item">Humidité : 44%</li>
                  </ul>
                  </div>
                </div>
                </div>
                <div class="card-footer text-muted">
                  <div class="row">
                  <div class="col-md-6 text-start"><i class="fas fa-temperature-low"></i> 10,3° (12/01/2021 08:52)</div>
                  <div class="col-md-6 text-end"><i class="fas fa-temperature-high"></i> 26,3° (12/01/2021 16:52)</div>
                  </div>
                </div>
            </div>';

    }
}