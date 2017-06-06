<div class="popup">
    <div class="container popup-content">
        <h2>Rezerwacja</h2>
        <hr>
        <form method="POST" class="form-horizontal" id="del_form">
            <label for="day" >Dzień:</label>
            <display id="day" class="form-control" value="<?=$this->variables['day']?>" name="day" ><?= $this->variables['days_lib'][$this->variables['day']] ?></display>
            <label for="hour">Godzina:</label>
            <display id="hour" class="form-control" value="<?=$this->variables['hour']?>" name="hour"><?= $this->variables['hour'].":00" ?></display>
            <input type="password" name="password" class="form-control" placeholder="Hasło"/>
            <div class="btn-toolbar pull-right">                
                <a id="btn-delete" class="btn btn-primary">Usuń</a>
                <a id="btn-cancel" class="btn btn-primary">Anuluj</a>
            </div>
        </form>
    </div>    
    <?= $this->helpers['Media']->js('utils'); ?>
</div>