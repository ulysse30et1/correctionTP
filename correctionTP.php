<?php
$titre = 'correction';
$months = [1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril', 5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août', 9 => 'septembre', 10 => 'octobre', 11 => 'novembre', 12 => 'décembre'];
$weekDays = ['lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche'];
$selectedYear = $_GET['year'] ?? date('Y');
$selectedMonthNumber = $_GET['month'] ?? date('n');
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $selectedMonthNumber, $selectedYear);
$firstDay = date('N' ,mktime(0, 0, 0, $selectedMonthNumber, 1, $selectedYear));
include 'header.php';
?>
<!-- creation du formulaire -->
<form action="" method="get">
    <label for="month">Mois :</label>
    <select name="month" id="month">
        <?php foreach ($months as $monthNumber => $month) : ?>
            <option value="<?= $monthNumber ?>" <?= $selectedMonthNumber == $monthNumber ? 'selected' : ''; ?>>
                <?= $month ?>
            </option>
        <?php endforeach; ?>
    </select>
    <label for="year">Année :</label>
    <select name="year" id="year">
        <?php for ($year = 1900; $year <= 2100; $year++) : ?>
            <option value="<?= $year ?>" <?= $selectedYear == $year ? 'selected' : ''; ?>>
                <?= $year ?>
            </option>
        <?php endfor; ?>
    </select>
    <input type="submit" value="valider">
</form>
<!-- affichage du tableau -->
<table>
    <thead>
        <tr>
            <?php foreach ($weekDays as $weekDay) : ?>
                <td><?= $weekDay ?></td>
            <?php endforeach; ?>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php 
            $day = 1;
            for($tile = 1; $tile <= $daysInMonth + $firstDay - 1; $tile++) :
                if ($tile < $firstDay) { ?>
                <td></td>
                <?php } else { ?>
                    <td><?= $day ?></td>
                <?php $day++; }  
                    if ($tile % 7 == 0) { ?>
                    </tr><tr>
                <?php }
            endfor; ?>
        </tr>
    </tbody>
</table>
<?php
include 'return.php';
include 'footer.php';