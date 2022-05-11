<div class="content">
        <div class="container-fluid">
          <div class="row">
          
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title">Adresar</h4>
                        <a href="index.php?page=zadatak1-forma" class="btn btn-warning">Dodaj korisnika</a>
                    </div>
                    <div class="card-body table-responsive">

                    <table class="table table-hover">

                        <thead class="text-warning">
                            <th>ID</th>
                            <th>Ime</th>
                            <th>Prezime</th>
                            <th>Izmeni</th>
                            <th>Obriši</th>
                        </thead>

                        <tbody id="kategorije">

                          <!-- PRIKAZ KORISNIKA -->

                          <?php
                            require_once "models/adresar/functions.php";
                            $podaci = getPodaci();

                            foreach($podaci as $key=> $value):
                              $imePrezime = explode(SEPARTOR, $value);
                          ?>

                          <tr>
                            <td><?= $key+1 ?></td>
                            <td><?= $imePrezime[0] ?></td>
                            <td><?= $imePrezime[1] ?></td>
                            <td>
                              <a href="index.php?page=zadatak1-forma&id=<?= $key ?>">Izmeni</a>
                            </td>
                            <td>
                              <a href="models/adresar/obrisi.php?id=<?=$key?>">Obrisi</a>
                            </td>
                          </tr>
                            <?php endforeach; ?>
                          <!--// PRIKAZ KORISNIKA -->
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
                           
          </div>
        </div>
      </div>