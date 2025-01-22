"Laboratorio - M-V-C - Esercitazioni
Sommario
Aggiungi intestazioni (Formato > Stili paragrafo) da visualizzare nel sommario.

Step 1 - Realizzazione classe Router
Nel M-V-C proprietario che realizzeremo, le richieste HTTP vengono instradate mediante un concetto di “routing”. Le route, per questo step, sono intese come coppie (controller, action).

https://…/index.php?controller=actors&action=show_all

Significa che bisogna “invocare” la classe controller che gestisce gli attori, diciamo “ActorsController” (istanziarla se i metodi non sono statici). Dopodiché si deve invocare il metodo specificato dalla action, diciamo “show_all”.

Realizza una classe Router con le seguenti funzionalità.
Riceve i dati di una richiesta HTTP
Verifica che la richiesta contenga l’indicazione del controller e della action
Ipotizzare controller e action di default (per difetto di specificazione: se non è stato specificato). Esempio (“pages”, “go_home”)
Estrae il nome del controller e della action

Ipotesi 1 - Più “semplice”, ma più rigida
Utilizza il costrutto “switch-case” per “importare” la classe corrispondente al controller specificato
Utilizza il costrutto “switch-case” per invocare il metodo corrispondente alla action specificata
Ipotesi 2 - 
Usa il nome del controller per costruire il nome della classe “actors” ⇒ “ActorsController”
Verifica che esista il file PHP corrispondente “Controller/ActorsController.php”
Se esiste, istanzia la classe (se serve)
Chiama il metodo corrispondente alla action (ad esempio “show_all”).


Step 2 - Realizzazione classi controller
Realizzare le classi controller per Actor e Film (Sakila) che espongono i metodi per le operazioni CRUD (ad esempio: “show” per mostrare i dati di una entità / oggetto, “show_all” per mostrare i dati di tutte le entità / oggetti di quel tipo, “insert” per visualizzare un form per l’inserimento di una nuova entità / oggetto, “do_insert” per ricevere da un form i dati per l’inserimento di una nuova entità / oggetto e eseguire l’inserimento, “update”, “do_update”, ecc.)

Inizialmente, per testare la corretta invocazione dei metodi del controller, è sufficiente che questi visualizzino un messaggio nella pagina.

I metodi del controller dovranno invocare gli opportuni metodi del Model e della View.

Approccio 1 - più “semplice” ma non il migliore
<form method="GET" action="index.php">
	<input type="hidden" name="controller" value="actors">
	<input type="hidden" name="action" value="do_insert">

	<input type="text" name="first_name">
	<input type="text" name="last_name">
	<input type="submit">
	<button >
	
</form>


<?php
// Router
$controller = $_GET['controller'];
$action = $_GET['action'];

// In ActorsController - metodo: do_insert
$firstName = $_GET['first_name'];

?>


Approccio 2 - pratica migliore
Separa l’instradamento “routing” dai dati utili “payload”.




<form method="POST" action="index.php?controller=actors&action=do_insert">
	<input type="text" name="first_name" id="first_name">
	<input type="text" name="last_name" id="last_name">
	
	<input type="submit" ...>
	<button ...>...</button>
</form>

<!-- 
Richiesta HTTP a server web "standard", pagine web
https://qualcosa/index.php?controller=actors&action=do_insert

Richiesta HTTP a server web ma precisamente web-service/API, ad esempio fetch API da Javascript / mobile
https://qualcosa/api/actors/do_insert
-->

<?php
// Router
$controller = $_GET['controller'];
$action = $_GET['action'];

// In ActorsController - metodo: do_insert
$firstName = $_POST['first_name'];
$firstName = $_POST['last_name'];
?>




Step 3 - Realizzazione e integrazione classi Model

Realizza le classi Model delle varie entità coinvolte dalle richieste HTTP (attori, film, ecc.) e integrale nella catena di chiamata.
Le classi model espongono i metodi che servono per le operazioni crud
get: riceve la chiave primaria dell’entità da estrarre e restituisce un oggetto della classe corrispondente.
Esempio Actor::get riceve l’ID dell’attore, estrae i dati dal database e restituisce un’istanza di Actor oppure null se l’ID non corrisponde ad alcun attore.
getAll: …
…
le classi model vengono invocate dai metodi delle classi controller.
ActorsController::show: risponde alla richiesta dell’utente di visualizzare uno specifico attore (...index.php?controller=actors&action=show&id=3)
Controlli vari (GET o POST? C’è l’id?)
Invoca il metodo della classe Model: Actor::get(<passa l’ID che hai ottenuto dalla richiesta>) e ottiene null oppure un’istanza di classe Actor.
Invoca una View che si occupa esclusivamente di visualizzare l’istanza estratta.
ActorsController::insert: risponde alla richiesta di inserire un nuovo attore (...index.php?controller=actors&action=insert)
Non ha bisogno di caricare alcuna istanza di Actor dal DB
Invoca una View che si occupa solamente di visualizzare un form per l’inserimento di un nuovo attore (chiaramente il form invierà i dati con un certo metodo ad un certo URL che contiene i dati per instradare la richiesta M-V-C)
Ricorda che abbiamo detto che si separano i dati per la route dal “payload”, cioè i dati del form.
ActorsController::do_insert: risponde alla richiesta di inserire nel DB i dati provenienti da un form HTML di inserimento (...controller=actors&action=do_insert)
Controlli vari (GET o POST? Ci sono i dati obbligatori provenienti dal form?)
Invoca il metodo della classe Model: Actor::insert<il nome varia in base all’approccio che segui ma avrà sempre la parola “insert”>(<riceve, in qualche modo, i dati provenienti dal form necessari a creare l’istanza e inserirla nel DB>).
Invoca una View che si occupa di visualizzare un feedback all’utente riguardo la riuscita dell’operazione.

Step 4 - Realizzazione e integrazione classi View
Realizza le classi View coinvolte dalle richieste HTTP (attori, film, ecc.) e integrale nella catena di chiamata. Le classi View sono quelle che si occupano dell’interfaccia utente (GUI).

Nel pattern architetturale “Model - View - Controller”, il compito di gestire le richieste dell’utente spetta al Controller. Tuttavia l’utente interagisce tramite l’interfaccia utente che è realizzata dalla View. Le operazioni che si possono richiedere sono, in linea di massima, relative alle CRUD.
Se l’operazione richiede la visualizzazione di dati, il Controller dovrà “passare la palla” al Model che è l’unico autorizzato a manipolare i dati.

Alcuni esempi di interazione tra questi componenti sono:
R: Read - Richiesta di visualizzare i dati di una singola entità
L’utente clicca su un collegamento del tipo …/index.php?...&id=4361
Oppure la richiesta parte da Javascript mediante pressione di un pulsante o cose simili, ma la richiesta è sempre un GET come sopra
Il Router instrada questa richiesta al metodo del Controller corrispondente alla action.
Il Controller invoca l’opportuno metodo del Model per estrarre i dati dell'istanza richiesta.
Il Model restituisce l’istanza (oppure null se non esiste) al Controller
Il Controller passa l’istanza al metodo della View che visualizza una singola istanza.
R: Read - Richiesta di visualizzare i dati di più entità
L’utente clicca su un collegamento del tipo …/index.php?controller=...&action=...
La richiesta è sempre tramite metodo GET
Il Router instrada questa richiesta al metodo del Controller corrispondente alla action.
Il Controller invoca l’opportuno metodo del Model per estrarre i dati delle istanze.
Il Model restituisce un array di istanze (oppure un array vuoto) al Controller.
Il Controller passa l’array al metodo della View che visualizza le istanze, generalmente in una tabella.
NOTA: non sempre un insieme di istanze viene rappresentato in forma tabulata (cioè sotto forma di tabella); a volte si utilizza una sequenza di div, con un div per ogni istanza.
A volte, per agevolare l’interazione con Javascript, si associa l’id dell’istanza alla riga della tabella oppure al div, a seconda della soluzione adottata.
Esempio (supponendo che l’entità abbia id=987)
<tr id=“987”>...
<div id=“987”>...




" 
