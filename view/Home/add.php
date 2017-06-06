<div class="popup">
    <div class="container popup-content">
        <h2>Rezerwacja</h2>
        <hr>
        <form method="POST" class="form-horizontal" id="add_form">
            <label for="day" >Dzień:</label>
            <display id="day" class="form-control" value="<?=$this->variables['day']?>" name="day" ><?= $this->variables['days_lib'][$this->variables['day']] ?></display>
            <label for="hour">Godzina:</label>
            <display id="hour" class="form-control" value="<?=$this->variables['hour']?>" name="hour"><?= $this->variables['hour'].":00" ?></display>
            <input class="form-control" type="text" name="name" placeholder="Imię"/>
            <input class="form-control" type="text" name="surname" placeholder="Nazwisko"/>      
            <input class="form-control" type="text" name="phone" placeholder="Telefon"/>
            <textarea placeholder="Temat spotkania" name="subject" class="form-control"></textarea>            
            <input class="form-control" type="password"  name="password" placeholder="Hasło"/>
            <div class="btn-toolbar pull-right">                
                <a id="btn-save" class="btn btn-primary">Zarezerwuj</a>
                <a id="btn-cancel" class="btn btn-primary">Anuluj</a>
            </div>
        </form>
    </div>    
    <?= $this->helpers['Media']->js('utils'); ?>
</div>