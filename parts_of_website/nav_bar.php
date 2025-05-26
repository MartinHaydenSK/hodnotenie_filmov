<?php
if (isset($_COOKIE['user'])) {
    $user_data = json_decode($_COOKIE['user'], true);
    $user_name = $user_data['meno'] . " " . $user_data['priezvisko'];
    echo "  <header>
    <h3>logo</h3>
    <nav>
      <ul style='list-style: none; display: flex; gap: 1rem; justify-content: center;'>
        <li><a href='./index.php'>Domov</a></li>
        <li><a href='./profil.php'>$user_data[meno] $user_data[priezvisko]</a></li>
        <li><a href='./regisrtation.php'>Registrácia</a></li>
        <li><a href='./login.php'>Prihlásenie</a></li>
        <li><a href='./hodnotenie.php'>Hodnotenie</a></li>
      </ul>
    </nav>
  </header>";
} else {
    echo "  <header>
    <h3>logo</h3>
    <nav>
      <ul style='list-style: none; display: flex; gap: 1rem; justify-content: center;'>
        <li><a href='./index.php'>Domov</a></li>
    
        <li><a href='./regisrtation.php'>Registrácia</a></li>
        <li><a href='./login.php'>Prihlásenie</a></li>
        <li><a href='./hodnotenie.php'>Hodnotenie</a></li>
      </ul>
    </nav>
  </header>";
}


?>