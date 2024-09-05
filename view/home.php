<!-- End Navbar -->

<div class="row">
  <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Penyakit</p>
              <h5 class="font-weight-bolder">
                <?= mysqli_num_rows(data_ph('Penyakit')); ?>
              </h5>
              <p class="mb-0">
                <span class="text-success text-sm font-weight-bolder">
                  <?= mysqli_num_rows(data_gejala('Penyakit')) ?>
                </span>
                Total Gejala
              </p>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
              <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Hama</p>
              <h5 class="font-weight-bolder">
                <?= mysqli_num_rows(data_ph('Hama')); ?>
              </h5>
              <p class="mb-0">
                <span class="text-success text-sm font-weight-bolder">
                  <?= mysqli_num_rows(data_gejala('Hama')) ?>
                </span>
                Total Gejala
              </p>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
              <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
    <div class="card">
      <div class="card-body p-3">
        <div class="row">
          <div class="col-8">
            <div class="numbers">
              <p class="text-sm mb-0 text-uppercase font-weight-bold">Diagnosa</p>
              <h5 class="font-weight-bolder">
                <?= mysqli_num_rows(data_diagnosa('','Penyakit')) + mysqli_num_rows(data_diagnosa('','Hama')); ?>
              </h5>
              <p class="mb-0">
                <span class="text-danger text-sm font-weight-bolder">Penyakit & hama</span>
              </p>
            </div>
          </div>
          <div class="col-4 text-end">
            <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
              <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row mt-4">
  <div class="col-lg-12 mb-lg-0 mb-4">
    <div class="card z-index-2 h-100">
      <!-- <div class="card-header pb-0 pt-3 bg-transparent">
        <h6 class="text-capitalize">Sistem Pakar</h6>
        <p class="text-sm mb-0">
          <i class="fa fa-arrow-up text-success"></i>
          <span class="font-weight-bold">Teorema Bayes</span>
        </p>
      </div> -->
      <div class="card-body p-3">
        <div class="text-center">
          <h3>
            Selamat datang <br>
            Di Sistem Pakar Diagnosa Penyakit Jeruk Siompu
          </h3>
        </div>
      </div>
    </div>
  </div>
</div>