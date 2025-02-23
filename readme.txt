Template LAMP base per codespaces
Contiene un esempio embrionale di autenticazione in PHP

- Guida minimale

Create il vostro account Github www.github.com e loggate.

Collegatevi a https://github.com/profPane/lamp

Premete il pulsante verde “Use this template” vi apparirà una pagina come da foto

Scegliete  “Open in a Codespaces” 

Si avvierà la versione WEB di VSCode e comincerà a costruire il vostro “codespace”, ci starà un po ma solo la prima volta, in basso a destra ci sara una barra di progresso.
Finita la creazione avrete l’ambiente VSCode attivo con tutti i files del progetto.

Avviate il server web Apachi dal terminale in basso a destra, se non dovesse esserci aprite un terminale dal menu di VSCode in alto a destra, le tre linee sovrapposte, è poi Terminale -> Nuovo Terminale
Nel terminale date il comando: 
apachectl start

Dopo qualche secondo si aprirà una finestra che vi avviserà che il server è attivo e che potete aprire una pagina web per visitarlo, cliccate “Open in Browser”, se per caso non dovesse apparire o lo chiudete voi potete sempre aprirlo andando sulla linguetta porte, nella riga della porta 80, passando col mouse sull’indirizzo (https:/….) vi apparirà un simbolo di “mondo” da cliccare

Il simbolo accanto al mondo vi permette di aprire un browser dentro VSCode che condivide lo spazio al centro con la finestra del sorgente, magari vi viene più comodo.

Se provate adesso ad usare il sito vi dirà che non esiste il DB, bisogna ripristinarlo da un backup, i backup si trovano nella cartella “dump_database”.


- Ripristino database di esempio

Dal terminale date il comando: 

mysql -u root -p -h 127.0.0.1

la password è “mariadb”, si avvia la console del database e da li create il database “club”: 

create database esempio;

Verrà creato il database, per usarlo dovete avvertire il motore database con il comando: 
use club; 
da questo momento in poi tutte le query verranno effettuate in quel database, alternativamente potete far precedere ai nomi delle tabelle quelle del DB, esempio SELECT * FROM iscritti; diventa SELECT * FRM club.iscritti;

Per uscire dal motore DB usate il comando: quit;

Adesso ripristiniamo il backup dal terminale, ATTENZIONE questo elimina ogni eventuale tabella preesistente con i suoi dati, con il comando:

mysql -p -u root esempio -h 127.0.0.1 < ../db/dump_database/esempio.sql

In qualsiasi momento potete fare un backup con il comando:

mysqldump -u root -p -h 127.0.0.1 club > db//dump_database/backup_nome_scelto.sql

attenzione al percorso del file, l’esempio vale se vi trovate con il terminale nella “root” del sito

- Gestore grafico del server database

Se volete gestire il DB in modalità grafica dentro VSCode potete installare l’estensione di VSCode: https://marketplace.visualstudio.com/items?itemName=cweijan.vscode-mysql-client2

Nella colonna a SX vi apparirà un simbolo Cilindrico, l’icona standard dei DB, cliccando potete creare una connessione al vostro DB, con i seguenti parametri: 
Connessione: mioDB, Host: 127.0.0.1, Nome (utente): root, Password: mariadb, Porta: 3306

Alternativamente potete installare phpMyAdmin 

- Pubblicare il vostro codice su GitHub

Oltre a tenerlo sulla macchina virtuale di codespaces potete salvare il vostro progetto su GitHub, cliccando su “Controllo del codice” cioè l’icona con i pallini collegati da linee, ogni volta volta che fate un buon numero di modifiche.

Vi verrà chiesto un “Messaggio” sintetico che descrive i cambiamenti fatti nel codice in questa sessione di programmazione, es: “sistemato errore di accesso al database”.

La prima volta vi verrà chiesto se volete che VSCode si occupi di preparare il codice, rispondete “sempre”  cioè il VOSTRO backup personale non quello da cui siete partiti.

Buon lavoro