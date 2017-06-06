<div class="page-content">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>
                            #
                        </th>
                        <?php foreach ($this->variables['hours'] as $hour) : ?>
                            <th>
                                <?= $hour->hour_value . ":00" ?>
                            </th>
                        <?php endforeach; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if (is_array($this->variables['possible_reservations'])): ?>
                        <?php foreach ($this->variables['possible_reservations'] as $key => $day): ?>
                            <tr>
                                <td>
                                    <?= $this->variables['days_lib'][$key] ?>
                                </td>
                                <?php foreach ($day as $reservation): ?>
                                    <td>
                                        <?php if ($reservation['val'] == 'N') : ?>
                                            <a day="<?= $reservation['day'] ?>" hour="<?= $reservation['hour'] ?>"  class="btn btn-primary book-add">Rezerwuj</a>
                                            <!--button--> 
                                        <?php elseif ($reservation['val'] == 'T') : ?>
                                            <span><?= $reservation['name'] . " " . $reservation['surname'] ?></span>
                                            <span><?= $reservation['subject'] ?></span>
                                            <a day="<?= $reservation['day'] ?>" hour="<?= $reservation['hour'] ?>"  class="btn btn-default book-del">Usuń rezerwacje</a>
                                            <!--delete-->
                                            <!--text-->
                                        <?php else : ?>
                                            <i>Niedostępne</i>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<div id="popup">

</div>