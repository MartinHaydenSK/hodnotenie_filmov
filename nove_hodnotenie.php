<?php
ob_start();
include_once './parts_of_website/nav_bar.php';
include_once './action_files/connecting_to_database.php';
include_once 'action_files/protect.php';
?>
  <style>
    /* Celkový kontajner – pevná šírka, left aligned */
    .rating-container {
      display: flex;
      flex-direction: column;
      align-items: flex-start; /* zarovnané doľava */
      gap: 10px;
      padding: 20px;
      width: 250px; /* Nastavte šírku podľa požadovaného rozostavenia hviezdičiek */
    }

    /* Hviezdičky rozmiestnené rovnomerne */
    .stars {
      display: flex;
      justify-content: space-between;
      width: 100%;
    }
    .stars span {
      /* Na istotu nastavíme aj šírku a centrovanie textu */
      width: 1.5em;
      text-align: center;
      color: #ccc;
      font-size: 24px;
      transition: color 0.3s ease;
    }

    /* Slider-container má rovnakú šírku ako hviezdičky */
    .slider-container {
      width: 100%;
    }

    /* Štýl input range – track s dynamickým gradientom */
    input[type="range"] {
      -webkit-appearance: none;
      width: 100%;
      height: 10px;
      background: linear-gradient(
        to right,
        gold var(--fill-percentage, 0%),
        #ccc var(--fill-percentage, 0%)
      );
      border-radius: 5px;
      outline: none;
      cursor: pointer;
      transition: background 0.3s ease;
    }

    /* WebKit: Slider thumb so stredovým posunom, aby bol centrovaný */
    input[type="range"]::-webkit-slider-thumb {
      -webkit-appearance: none;
      width: 22px;
      height: 22px;
      background: gold;
      border-radius: 50%;
      box-shadow: 0 0 5px rgba(0,0,0,0.3);
      cursor: pointer;
      /* Zabezpečí, že stred thumbu je presne na vypočítanej hodnote */
      transform: translateX(-50%);
      transition: transform 0.2s ease;
    }
    input[type="range"]::-webkit-slider-thumb:hover {
      transform: translateX(-50%) scale(1.1);
    }

    /* Firefox štýly – thumb a track */
    input[type="range"]::-moz-range-thumb {
      width: 22px;
      height: 22px;
      background: gold;
      border-radius: 50%;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
      cursor: pointer;
    }
    input[type="range"]::-moz-range-track {
      height: 10px;
      background: linear-gradient(
        to right,
        gold var(--fill-percentage, 0%),
        #ccc var(--fill-percentage, 0%)
      );
      border-radius: 5px;
      transition: background 0.3s ease;
    }
  </style>

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
        echo "<h2>Si prihlásený ako, $user_name</h2>
                <h2>Vaša recenzia</h2>";
        echo '<form action="" method="post">
    <label for="nazov">Názov filmu</label>
    <input type="text" name="nazov" />
    <label for="žáner">Vyberte filmový žáner:</label>
    <select name="žáner" >
      <option value="" disabled selected>-- Vyberte žáner --</option>
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
    </br>
    <label for="recenzia">recenzia</label>
    <textarea name="recenzia" rows="4" cols="50">Tu napíš svoju recenziu</textarea>
    </br>
       <div class="rating-container">
    <div class="stars">
      <span>★</span>
      <span>★</span>
      <span>★</span>
      <span>★</span>
      <span>★</span>
    </div>
    <div class="slider-container">
      <!-- Slider s hodnotami od 1 do 5 -->
      <input type="range" id="rating" name="rating" min="1" max="5" step="1" value="1" oninput="updateRating(this.value)">
    </div>
  </div>
    <input type="submit" name="submit" id="" value="Poslať" /> 
    </form>
    </br>';
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
    if (!empty($_POST['nazov']) && !empty($_POST['recenzia']) && !empty($_POST['žáner']) && !empty($_POST['rating'])){ 
        $nazov = Tprotect($_POST['nazov']);
        $recenzia = Tprotect($_POST['recenzia']);
        $žáner = $_POST['žáner'];
        $rating = $_POST['rating'];
        $ID_pouzivatel = $user_data['id'];
        $datum = date('Y-m-d');

        $sql = "INSERT INTO hodnotenie_filmov.hodnotenie (nazov, recenzia, žáner, rating, ID_pouzivatel, datum) VALUES ('$nazov', '$recenzia', '$žáner' , '$rating' , '$ID_pouzivatel', '$datum');";
        mysqli_query($conn, $sql);
        
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}
        } else {
        echo "Ste príhlásený ako hosť (ak chceťe zverejňovať príspevky, musíte sa prihlásiť). </br></br>";
    }
    echo "</br>";
    //echo date('Y-m-d');
    //echo time();
?>
<form action="" method="post">
    <label for="žáner_fil">Vyberte filmový žáner:</label>
    <select name="žáner_fil" >
      <option value="" disabled selected>-- Vyberte žáner --</option>
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
      <option value="" disabled selected>-- Vyberte zoradenie --</option>
      <option value="DESC">Zostupne</option>
      <option value="ASC">Vzostupne</option>
    </select>
    <input type="submit" name="submit" id="" value="Filtrovať"/> 
    </form>

<script>
    function updateRating(value) {
      // Aktualizácia farby hviezdičiek – gold pre tie, ktoré majú index nižší ako zvolená hodnota.
      const stars = document.querySelectorAll('.stars span');
      stars.forEach((star, index) => {
        star.style.color = index < value ? 'gold' : '#ccc';
      });
      
      // Výpočet percentuálneho vyplnenia slider tracku.
      // Pre hodnotu = 1 (prvá hviezdička) chceme 0% vyplnenia; pre hodnotu = 5, 100%.
      const minVal = 1, maxVal = 5;
      const percentage = ((value - minVal) / (maxVal - minVal)) * 100 + "%";
      document.getElementById("rating").style.setProperty("--fill-percentage", percentage);
    }

    // Inicializácia slidera a hviezdičiek pri načítaní stránky
    window.addEventListener("DOMContentLoaded", function() {
      const ratingInput = document.getElementById("rating");
      updateRating(ratingInput.value);
    });
  </script>
</body>

</html>
<?php
// Vypustenie vyrovnávacej pamäte (bufferu) a odoslanie výstupu
ob_end_flush();
?>