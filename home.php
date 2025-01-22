<?php
// Include il Router, Controller o altre configurazioni necessarie
require_once 'Router.php'; 
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Sistema di Gestione Attori</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <header>
        <h1>Benvenuto nel Sistema di Gestione Attori</h1>
        <nav>
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="index.php?controller=actors&action=show_all">Visualizza tutti gli attori</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="buttons-container">
            <h2>Seleziona un'opzione</h2>

            <!-- Pulsante per visualizzare tutti gli attori -->
            <form method="GET" action="index.php">
                <input type="hidden" name="controller" value="actors">
                <input type="hidden" name="action" value="show_all">
                <button type="submit" class="btn">Visualizza Tutti gli Attori</button>
            </form>

            <!-- Pulsante per fare una ricerca mirata -->
            <form method="GET" action="index.php">
                <input type="hidden" name="controller" value="actors">
                <input type="hidden" name="action" value="search">
                <label for="search">Cerca attore per nome:</label>
                <input type="text" id="search" name="search" placeholder="Inserisci nome o cognome">
                <button type="submit" class="btn">Cerca Attore</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; Nicola Frezza ITT Vittorio Veneto Città della Vittoria</p>
    </footer>
</body>
</html>
