<div class="content">
        <div class="container-fluid">
          <div class="row">
          
          <div class="col-sm-8">
                <div class="card">
                    <div class="card-header card-header-warning">
                        <h4 class="card-title" id="forma-naslov">Dodaj korisnika</h4>
                    </div>
                    <div class="card-body table-responsive">


                    <?php
                        $id = "";
                        $imePrezime ="";

                        $isUpdate = false;

                        if(isset($_GET['id'])){
                            $id = $_GET['id'];
                            $isUpdate = true; 

                            require_once "models/adresar/functions.php";

                            $imePrezime = getRed($id);
                        }

                    ?>
                    <!-- FORMA ZA UNOS -->
                    <form id="forma" action="<?= ($isUpdate)? "models/adresar/izmeni.php" : "models/adresar/unesi.php" ?>" method="POST">

                        <input type="hidden" name="id" value="<?= ($isUpdate)? $id : '' ?>"/>
                        
                        <div class="input-field">
                            <input type="text" id="ime" 
                            name="ime"
                            value="<?= ($isUpdate)? $imePrezime[0] : '' ?>"
                            placeholder="Unesi ime" class="validate">
                            <label for="naziv">Ime</label>
                        </div>
                        <div class="input-field">
                            <input type="text" 
                            name="prezime"
                            value="<?= ($isUpdate)? $imePrezime[1] : '' ?>"
                            id="prezime" placeholder="Unesi prezime" class="validate">
                            <label for="naziv">Prezime</label>
                        </div>
                       
                        <div class="input-field">
                            <input type="submit"
                            name="btnSacuvaj" value="Sačuvaj" class="btn btn-success col s12"/>
                        </div>   
                    </form>
                    <!--// FORMA ZA UNOS -->

                    </div>
                </div>
                
            </div> 
                           
          </div>
        </div>
      </div>