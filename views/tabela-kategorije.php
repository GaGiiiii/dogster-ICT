<div class="content">
        <div class="container-fluid">
          <div class="row">
          
            <div class="col-sm-8">
                <div class="card">
                    <div class="card-header card-header-success">
                        <h4 class="card-title">Kategorije</h4>
                    </div>
                    <div class="card-body table-responsive">

                    <table class="table table-hover">

                        <thead class="text-warning">
                            <th>ID</th>
                            <th>Naziv</th>
                            <th>Izmeni</th>
                            <th>Obriši</th>
                        </thead>

                        <tbody id="kategorije">

                          <!-- PRIKAZ KATEGORIJA -->
                          <?php
                            require_once "models/kategorije/functions.php";
                            
                            $kategorije = getCategories();
                            $rb = 1;
                            foreach($kategorije as $kategorija):
                          ?>
                          <tr>
                            <td><?= $rb++; ?></td>
                            <td><?= $kategorija->name ?></td>
                            <td>
                              <a href="#" class="update-kategorija" data-id="<?= $kategorija->id ?>">Izmeni</a>
                            </td>
                            <td>
                              <a href="#" class="delete-kategorija" data-id="<?= $kategorija->id ?>">Obrisi</a>
                            </td>
                          </tr>
                            <?php endforeach; ?>   
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title" id="forma-naslov">Dodaj kategoriju</h4>
                    </div>
                    <div class="card-body table-responsive">

                    <!-- FORMA ZA UNOS -->
                    <form id="forma">
                        <input type="hidden" id="hdnId" />

                        <div class="input-field">
                            <input type="text" id="naziv" placeholder="Unesi naziv" class="validate">
                            <label for="naziv">Naziv</label>
                        </div>
                       
                        <div class="input-field">
                            <input type="button" value="Sačuvaj" id="btnSacuvaj" class="btn btn-success col s12"/>
                        </div>   
                    </form>
                    <!--// FORMA ZA UNOS -->

                    </div>
                </div>
                
            </div>                
          </div>
        </div>
      </div>