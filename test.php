
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Хотите выйти?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
        <a href="logout.php"><button type="button" class="btn btn-primary">Да</button></a>
      </div>
    </div>
  </div>
</div>  



<!-- Modal filter-->
<div class="modal fade" id="filter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="#" method="POST" class="horizntal-form" id="order_form">
            <div class="row">
                <div class="col-md-6">
                    <span>Контрагент</span>
                </div>
                <div class="col-md-3">
                        <span>Дата начала</span>
                </div>
                <div class="col-md-3">
                        <span>Дата конца</span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6"> 
                    <select required class="normalize" name="id_contractor" form="order_form">
                        <option value="">Выберите: </option>
                        <?php    
                            while ($option_contractor = mysqli_fetch_array($counterparties_tbl)) {    
                        ?>
                            <option value="<?php echo $option_contractor["id"];?>"><?php echo $option_contractor["name"]?></option>
                        <?php
                            };    
                        ?>
                    </select>
                </div>
                <div class="col-md-3"> 
                    <input required type="date" value="<?php echo date("Y-m-d"); ?>" class="form-control" name="from_date" form="order_form">
                </div>
                
                <div class="col-md-3">
                    <input required type="date" value="<?php echo date("Y-m-d"); ?>" class="form-control" name="to_date" form="order_form">
                </div>    
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Нет</button>
        <a href="logout.php"><button type="button" class="btn btn-primary">Да</button></a>
      </div>
    </div>
  </div>
</div>  