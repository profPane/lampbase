Template LAMP base per codespaces
Contiene anche un esempio embrionale di autenticazione in PHP

GUIDA per i primi passi.

1) Creazione codespace a partire dal template”

Create il vostro account Github www.github.com e loggate.

Collegatevi a https://github.com/profPane/lampbase

Premete il pulsante verde “Use this template” vi apparirà una pagina come da foto

Scegliete  “Open in a Codespaces” 

Si avvierà la versione WEB di VSCode e comincerà a costruire il vostro “codespace”, ci starà un po ma solo la prima volta, in basso a destra ci sara una barra di progresso.
Finita la creazione avrete l’ambiente VSCode attivo con tutti i files del progetto.

Avviate il Server Web Apache dal terminale in basso a destra, se non dovesse esserci aprite un terminale dal menu di VSCode in alto a destra, le tre linee sovrapposte, è poi Terminale -> Nuovo Terminale

Nel terminale date il comando: 
apachectl start

Dopo qualche secondo si aprirà una finestra che vi avviserà che il server è attivo e che potete aprire una pagina web per visitarlo, cliccate “Open in Browser”, se per caso non dovesse apparire o lo chiudete voi potete sempre aprirlo andando sulla linguetta porte, nella riga della porta 80, passando col mouse sull’indirizzo (https:/….) vi apparirà un simbolo di “mondo” da cliccare

Il simbolo accanto al mondo vi permette di aprire un browser dentro VSCode che condivide lo spazio al centro con la finestra del sorgente, magari vi viene più comodo.

Se provate adesso ad usare il sito vi dirà che non esiste il DB, bisogna ripristinarlo da un backup, i backup si trovano nella cartella “dump_database”.


2) Ripristino database di esempio
Nel template è incluso un esempio base di connessione al DB con PHP per la realizzazione di pagine dinamiche, se volete provarlo dovete ripristinare il DB dell'applicazione

Dal terminale date il comando: 

mysql -u root -p -h 127.0.0.1

la password è “mariadb”, si avvia la console del database, è fondamentale distinguere tra il terminale (linux) e la console (DB) che vi permette di eseguire le query, da li create il database “esempio”: 

create database esempio;

Verrà creato il database VUOTO, per usarlo dovete avvertire il motore database con il comando: 

use esempio; 

da questo momento in poi tutte le query dalla console del database verranno effettuate in quel database, alternativamente potete far precedere ai nomi delle tabelle quelle del DB, esempio SELECT * FROM iscritti; diventa SELECT * FRM esempio.iscritti;

Per uscire dal motore DB usate il comando: 

quit;

Se volete provare l'esempio di autenticazione ripristinate il backup dalle TABELLE terminale, ATTENZIONE questo elimina ogni eventuale tabella preesistente:

mysql -p -u root esempio -h 127.0.0.1 < db/dump_database/esempio.sql

In qualsiasi momento potete fare un backup con il comando:

mysqldump -u root -p -h 127.0.0.1 esempio > db/dump_database/backup_nome_scelto.sql

attenzione al percorso del file, l’esempio vale se vi trovate con il terminale nella “root” del sito

3) Gestore grafico del server database

Se volete gestire il DB in modalità grafica dentro VSCode potete installare l’estensione di VSCode: https://marketplace.visualstudio.com/items?itemName=cweijan.vscode-mysql-client2

Nella colonna a SX vi apparirà un simbolo Cilindrico, l’icona standard dei DB, cliccando potete creare una connessione al vostro DB, con i seguenti parametri: 
Connessione: mioDB, Host: 127.0.0.1, Nome (utente): root, Password: mariadb, Porta: 3306

Alternativamente potete installare phpMyAdmin:
sudo apt install phpmyadmin

4) Pubblicare il vostro codice su GitHub

Oltre a tenerlo sulla macchina virtuale di codespaces potete salvare il vostro progetto su GitHub, cliccando su “Controllo del codice” cioè l’icona con i pallini collegati da linee.

Vi verrà chiesto un “Messaggio” sintetico che descrive i cambiamenti fatti nel codice in questa sessione di programmazione, es: “sistemato errore di accesso al database”.

La prima volta vi verrà chiesto se volete che VSCode si occupi di preparare il codice, rispondete “sempre”  

Sempre la prima volta vi viene chiesto se volete creare un nuovo "BRANCH" cioè un repository su Github.
Si aprirà un browser per loggare su github se non siete già loggati con un pulsante per collegare GitHub al vostro codespace
Poi vi verrà chiesto se volete rendere pubblico o privato il vostro deposito ed un nome, alla fine premete i pulsati Commit ed Sincronizza che appariranno
Da questo momento in poi

Da adesso in poi, ogni volta volta che fate un buon numero di modifiche, potete sincronizzarle con il vostro "deposito" github, creando un nuovo commit. 

Buon lavoro