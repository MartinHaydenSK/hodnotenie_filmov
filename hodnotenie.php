<?php
include_once './parts_of_website/nav_bar.php';
include_once './action_files/connecting_to_database.php';
include_once 'action_files/protect.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hodnotenie</title>
</head>
<body>
    <?php
if (isset($_COOKIE['user'])) {
        $user_data = json_decode($_COOKIE['user'], true);
        $user_name = $user_data['meno'] . " " . $user_data['priezvisko'];
        echo "<h2>Si prihlásený ako, $user_name</h2>";
        echo "<a href='nove_hodnotenie.php'>NAPÍSAŤ RECENZIU</a> ";
        
        } else {
        echo "Ste príhlásený ako hosť (ak chceťe zverejňovať príspevky, musíte sa prihlásiť). </br></br>";
    }
?>
<form action="" method="post">
    <label for="žáner_fil">Vyberte filmový žáner:</label>
    <select name="žáner_fil" >
      <option value="" selected>-- Vyberte žáner --</option>
      <option value="akcny">Akčný</option>
      <option value="dobrodruzny">Dobrodružný</option>
      <option value="animovany">Animovaný</option>
      <option value="biograficky">Biografický</option>
      <option value="komedia">Komédia</option>
      <option value="krimi">Krimi</option>
      <option value="dokumentarny">Dokumentárny</option>
      <option value="drama">Dráma</option>
      <option value="rodinny">Rodinný</option>
      <option value="fantasy">Fantasy</option>
      <option value="historicky">Historický</option>
      <option value="horor">Horor</option>
      <option value="mysteriozny">Mysteriózny</option>
      <option value="romanticky">Romantický</option>
      <option value="scifi">Sci-Fi</option>
      <option value="sportovy">Športový</option>
      <option value="thriller">Thriller</option>
      <option value="vojnovy">Vojnový</option>
      <option value="western">Western</option>
      <option value="muzikal">Muzikál</option>
      <option value="experimentálny">Experimentálny</option>
    </select>
    <label for="zoradenie">Vyberte filmový žáner:</label>
    <select name="zoradenie" >
      <option value="DESC" selected>-- Vyberte zoradenie --</option>
      <option value="DESC">Zostupne</option>
      <option value="ASC">Vzostupne</option>
    </select>
    <input type="submit" name="submit" id="" value="Filtrovať"/> 
    </form>
<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    $žáner_fil = $_POST['žáner_fil'];
    $zoradenie = $_POST['zoradenie'];
    if(empty($žáner_fil)){
        $sqlSel = "SELECT hodnotenie.nazov, hodnotenie.recenzia, hodnotenie.žáner, hodnotenie.rating, hodnotenie.datum, použivateľ.meno, použivateľ.id FROM hodnotenie 
        JOIN použivateľ ON hodnotenie.ID_pouzivatel = použivateľ.id ORDER BY hodnotenie.datum $zoradenie";
    }else if(!empty($žáner_fil)){
    $sqlSel = "SELECT hodnotenie.nazov, hodnotenie.recenzia, hodnotenie.žáner, hodnotenie.rating, hodnotenie.datum, použivateľ.meno, použivateľ.id FROM hodnotenie 
 JOIN použivateľ ON hodnotenie.ID_pouzivatel = použivateľ.id ORDER BY hodnotenie.datum $zoradenie WHERE hodnotenie.žáner='$žáner_fil';";
 }
}else{
    $sqlSel = "SELECT hodnotenie.nazov, hodnotenie.recenzia, hodnotenie.žáner, hodnotenie.rating, hodnotenie.datum, použivateľ.meno, použivateľ.id FROM hodnotenie 
 JOIN použivateľ ON hodnotenie.ID_pouzivatel = použivateľ.id ORDER BY hodnotenie.datum DESC;";

}
 $result = mysqli_query($conn, $sqlSel);
if(mysqli_num_rows($result) > 0){
  while($row = mysqli_fetch_assoc($result)){
    echo "film: ". $row['nazov'] . " recenzia: ". $row['recenzia'] . " hodnotenie: ". $row['rating'] . ' od: <a href="profil_pouzivatela.php?id=' . $row["id"] . '">' . $row['meno'] . '</a> ' . " zverejnené: " . $row['datum'] . "</br> </br>";
 }  
}else{
    echo "Žiadne výsledky";
    $sqlSel = "SELECT hodnotenie.nazov, hodnotenie.recenzia, hodnotenie.žáner, hodnotenie.rating, hodnotenie.datum, použivateľ.meno, použivateľ.id FROM hodnotenie 
 JOIN použivateľ ON hodnotenie.ID_pouzivatel = použivateľ.id ORDER BY hodnotenie.datum DESC;";
}
 
 
?>
</body>

</html>
