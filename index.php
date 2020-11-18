<?php
$inims = simplexml_load_file("andmed.xml");
function searchByCompName($query){
    global $inims;
    $result=array();
    foreach($inims -> nimi as $comp) {
        if (substr(strtolower($comp->sugu), 0, strlen($query)) == strtolower($query)) {
            array_push($result, $comp);
        }
    }
    return $result;
}

?>

<!DOCTYPE html>
<html lang="et">
<head>
    <title>Autocompleter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-CuOF+2SnTUfTwSZjCXf01h7uYhfOBuxIhGKPbfEJ3+FqH/s6cIFN9bGr1HmAg4fQ" crossorigin="anonymous">
</head>
<body>
<h1 class="d-flex justify-content-center">Autocompleter</h1>
<br><br>
<div class="d-flex justify-content-around">
    <form action="?" id="searchShow2" class="hide" method="post">
        Otsing: <input type="text" name="search" placeholder="Sugu">
        <input type="submit" class="btn btn-secondary my-2 my-sm-0" value="Otsi">
    </form>
</div>
<br><br>
<input type="radio" id="tahed" name="otsing" value="tahe" checked>
<?php if (isset($otsing) && $otsing=="tahe" )echo "checked";?>
<label for="tahe">2 tähe</label><br>
<input type="radio" id="female" name="otsing" value="emakeni">
<?php if (isset($otsing) && $otsing="emakeni") echo "checked";?>
<label for="female">Emakeelne nimi</label><br>
<input type="radio" id="other" name="otsing" value="vorkelni">
<?php if (isset($otsing) && $otsing="vorkelni") echo "checked";?>
<label for="other">Võõrkeelne nimi</label>
<br><br>
<table class="table table-dark" border="1">
    <thead class="table-striped table-dark">
    <tr>
        <th>Sugu</th>
        <th>Emakeelne nimi</th>
        <th>Võõrkeelne nimi</th>
    </tr>
    </thead>
    <?php

    if(!empty($_POST["search"])){
        $result=searchByCompName($_POST["search"]);
        foreach($result as $comp){
            echo "<tr><td>".($comp -> sugu)."</td><td>".($comp -> emakeni)."</td><td>".($comp -> vorkelni)."</td>";
            echo "</tr>";
        }
    }


    ?>
</table>
</body>
</html>