@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/landing')

@section('title', 'Privacy policy')


<!-- CSS Starts -->
@section('head-style') 

<!-- CSS: Framework Declaration -->
<link rel="stylesheet" href="{{asset('assets/front/plugins/uikit-3.16.22/css/uikit.min.css')}}" />

<!-- CSS: Fonts Declaration -->
<link rel="stylesheet" href="{{asset('assets/front/css/components/fonts.css')}}" />
<link rel="stylesheet" href="{{asset('assets/css/wf-icon/style.css')}}" />

<!-- CSS: Layout Setup -->
<link rel="stylesheet" href="{{asset('assets/front/css/layout/var.css')}}" />
<link rel="stylesheet" href="{{asset('assets/front/css/components/common.css')}}" />
<link rel="stylesheet" href="{{asset('assets/front/css/layout/header.css?ver=1')}}" />
<link rel="stylesheet" href="{{asset('assets/front/css/layout/footer.css')}}" />


<!-- CSS: Pagevise CSS -->
<link rel="stylesheet" href="{{asset('assets/front/css/pages/pages.css')}}" />
@endsection
<!-- CSS Ends -->

@section('content')

@include('_partials/_front/header')

<main id="main-content" class="wrapper">

    <div class="support">
        <div class="uk-container support__container">
            <div class="uk-grid gutter-xl support__grid" data-uk-grid>
                <div class="uk-width-auto support__col support__col--sidebar">
                    
                </div>
                
                <div class="uk-width-expand support__col support__col--content">
                    
                    <h1 class="title title--xl support__maintitle">Gestione dei Cookie</h1>
                    <h2 class="support__maintext">Version: 1.0.0</h2>
                    <div class="support__text">
                        <p>
                            <strong>1. Definizione di cookie</strong> 
                        </p>
                        <p>
                        1.1. Willfeed raccoglie e tratta dati personali. Tali dati personali sono utilizzati per
identificare il computer, browser o eventuali dispositivi mobili utilizzati per navigare su
Internet. I dati personali sono raccolti attraverso il Sito per mezzo di piccoli file di testo
e altri sistemi di tracciamento (“Cookies”).
                        </p>
                        <p>
                            <strong>2. Conferimento dei dati e basi giuridiche</strong>
                        </p>
                        <p>
                        2.1. L’installazione dei cookie tecnici o analitici anonimizzati, ai sensi della direttiva n.
58/2002 e del Codice Privacy (D.l.vo n. 196/2003) non richiede la manifestazione di
un consenso da parte dell’utente, costituendo dette normative la base giuridica del
trattamento.
                        </p>
                        <p>
                        2.2. Accedendo alla Piattaforma per la prima volta, viene mostrata all’utente una breve
informativa sull’utilizzo dei Cookie tramite un banner a comparsa immediata.
Cliccando sul tasto “Accetta” del banner consente all’installazione di tutti i Cookie. In
alternativa può impostare le sue preferenze sui cookie cliccando sul tasto “Gestisci le
preferenze sui cookie” e regolare i pulsanti di opzione disponibili su “SI” o “NO”. Le
preferenze possono essere modificate da questa pagina __________ in qualsiasi
momento.
                        </p>
                        <p>
                        2.3. Cliccando sul pulsante “Rifiuta”, sul simbolo "X" in alto a destra del banner o sul
pulsante "Gestisci le preferenze sui cookie", l'utente potrà negare il proprio consenso
all'installazione dei cookie o decidere se acconsentire a tale installazione. In ogni caso,
sarà possibile accedere al Sito anche dopo aver rifiutato l'installazione dei cookie.
L’utente può anche impostare il proprio browser web in modo da rifiutare l'installazione
dei cookie per impostazione predefinita o cancellare tutti i cookie installati dal vostro
computer o dispositivo mobile. La procedura varia a seconda delle impostazioni
specifiche del browser web utilizzato.
                        </p>
                        <p>
                        2.4. Continuando la navigazione sul sito con chiusura del banner contenente
l’informativa breve tramite il comando contraddistinto dalla “X” o anche in caso di
selezione del comando “Rifiuta tutti”, saranno applicate le impostazioni con
installazione dei soli cookie o strumenti di tracciamento tecnici e statistici anonimi. Il
conferimento dei Dati trattati mediante l’installazione di cookie tecnici e cookie
analitici, seppur facoltativo, è necessario per garantire la corretta navigazione all’interno
del Sito. Nel caso in cui l’utente decida di disattivare i cookie tecnici e analitici, non
potrà avere accesso a molte caratteristiche che rendono la Piattaforma più efficiente e
alcuni dei servizi offerti non funzioneranno in modo corretto.
                        </p>
                        <p>
                        2.5. Rimane del tutto facoltativo prestare il consenso all’installazione dei cookie di
profilazione di prima e di terza parte come di seguito indicati. I Dati di ciascun utente saranno trattati attraverso l’installazione di tali cookie solo previo il suo espresso
consenso (che costituisce la base giuridica del trattamento), conferito cliccando sul
pulsante “Accetta” o personalizzando le proprie preferenze in tal senso.
                        </p>
                        <p>
                            <strong>3. Cookie di prima parte</strong>
                        </p>
                        <p>3.1. I Cookie di prima parte includono solo Cookie tecnici. Questi Cookie sono
strettamente necessari per migliorare l’esperienza di navigazione e garantire le
funzionalità tecniche fondamentali del Sito (ad esempio, vengono utilizzati per
visualizzare i contenuti del Sito o per ricordare le preferenze di consenso degli utenti).
Il consenso dell’utente non è necessario per consentire a Willfeed di raccogliere
informazioni e di installare questa particolare categoria di cookie; ciò in quanto la
raccolta, in questo caso, poggia sulla base giuridica del legittimo interesse commerciale
di Willfeed a fornire l'accesso alla propria Piattaforma nel miglior modo possibile.</p>
                        </p>
                        <p>
                        3.2. Più nel dettaglio, le finalità principali dei cookie di prima parte installati da Willfeed
sono:
(i) tecniche, vengono cioè utilizzati per finalità connesse all’erogazione del servizio e per
consentire o migliorare la navigazione sulla piattaforma o memorizzare le ricerche. Tali
cookie sono indispensabili per garantire alla Piattaforma un corretto funzionamento;
(ii) analitiche, per raccogliere informazioni statistiche sull’utilizzo del servizio da parte
degli utenti (e.g. numero visitatori, pagine visitate, ecc.). Willfeed utilizza questi cookie
per analizzare il traffico sulle proprie pagine in modo anonimo, senza memorizzare dati
personali;
(iii) analizzare le abitudini, scelte di consumo e posizione geografica al fine di
promuovere pubblicità personalizzata anche di terze parti a cui possono essere
comunicate informazioni che non identificano direttamente l’utente.
                        </p>
                        <p>
                        3.3. È possibile visualizzare la lista di tutti i cookie utilizzati da Willfeed con i relativi
tempi di conservazione dei medesimi nella sezione cookie delle impostazioni al seguente
collegamento ________. Willfeed, oltre ai cookie, per migliorare il servizio e per attività
di profilazione, utilizza anche tecnologie similari sui dispositivi mobili. Willfeed, oltre ai
cookie, per migliorare il servizio e per attività di profilazione, utilizza anche tecnologie
similari sui dispositivi mobili.
                        </p>
                        <p>
                            <strong>4. Cookie di terza parte</strong>
                        </p>
                        <p>
                        4.1. I Cookie di terze parti includono i Cookie analitici. Questi Cookie sono utilizzati a
fini di analisi statistica e per raccogliere informazioni sull’esperienza degli utenti sul Sito
solo in forma aggregata e anonima (ad esempio, sono utilizzati per contare il numero di
visite degli utenti sul Sito). Il consenso da parte dell’utente non è necessario per
consentire a Willfeed di raccogliere informazioni di installare questa particolare
categoria di Cookie; ciò in quanto la raccolta, in questo caso, poggia sulla base giuridica
del legittimo interesse commerciale di Willfeed a raccogliere informazioni strettamente
finalizzate all'analisi delle prestazioni del nostro Sito in termini di portata, visibilità e
accessibilità online.
                        </p>
                        <p>
                        4.2. I Cookie di terze parti comprendono anche i Cookie di marketing. Questi cookie
sono installati attraverso il Sito da partner selezionati al fine di raccogliere dati personali
sull'utente e visualizzare pubblicità mirata e personalizzata in base alle preferenze
espresse dall'utente durante la sessione di navigazione (ad esempio, quando visita alcune
pagine del Sito o interagisce con le funzionalità del Sito). Per l'installazione di tali Cookie
di marketing è necessario l’esplicito consenso da parte dell’utente.
                        </p>
                        <p>
                        4.3 Willfeed, oltre ai cookie, per migliorare il servizio e la navigazione o per attività di
profilazione, potrebbe consentire l’utilizzo di tecnologie similari sui dispositivi mobili
gestite da società terze. L’impiego delle suddette tecnologie è regolato dalle informative
sulla privacy di dette società e non dall’informativa privacy di Willfeed.
Per le attività di profilazione, i dati personali raccolti tramite cookie sono trattati per un
periodo massimo di 12 mesi dal momento in cui viene prestato il consenso al
trattamento.
È possibile visualizzare la lista di tutti i cookie utilizzati da Willfeed con i relativi tempi
di conservazione dei medesimi da questo link ___________
                        </p>
                        <p>
                            <strong>5. Destinatari dei dati raccolti</strong>
                        </p>
                        <p>
                        5.1. I Dati potranno essere conosciuti e trattati dai dipendenti delle funzioni aziendali
di Willfeed deputate al perseguimento delle finalità sopra indicate, espressamente
autorizzati al trattamento e che hanno ricevuto adeguate istruzioni operative.
                        </p>
                        <p>
                        5.2. Inoltre, i Dati potranno essere comunicati a terzi destinatari – titolari autonomi del
trattamento o debitamente designati quali responsabili del trattamento – che
appartengono alle seguenti categorie:
a) soggetti esterni operanti in qualità di titolari autonomi quali, a titolo esemplificativo,
Autorità ed organi di vigilanza e controllo ed in generale a soggetti, anche privati,
legittimati a richiedere i dati (come ad esempio consulenti contabili, consulenti legali),
Pubbliche Autorità che ne facciano espressa richiesta per finalità amministrative o
istituzionali, soggetti che gestiscono i cookie di Terza parte, secondo quanto disposto
dalla normativa vigente nazionale ed europea;
b) soggetti estranei al Titolare che forniscono servizi allo stesso e che sono utili per le
sue attività (ad esempio: fornitori di servizi informatici e consulenti che rendono
assistenza tecnica al Titolare, società che offrono supporto nella realizzazione di studi
di mercato); questi soggetti ricevono uno specifico incarico come responsabili del
trattamento dei dati e i loro nominativi sono disponibili su richiesta, utilizzando i
recapiti indicati nella presente policy.
                        </p>
                        <p>
                        5.3. I Dati raccolti utilizzando i cookie presenti sul Sito non saranno oggetto di
trasferimento al di fuori dell’Unione Europea.
Ove ciò avvenga, in riferimento ai Dati raccolti utilizzando i cookie presenti sul Sito, il
Titolare, per quanto di propria competenza, adotterà delle garanzie appropriate, tra cui
le decisioni di adeguatezza in vigore e le clausole contrattuali standard (Standard
Contractual Clauses) adottate dalla Commissione Europea.
                        </p>
                        <p>
                            <strong>6. Consenso all’uso dei cookie</strong>
                        </p>
                        <p>
                        6.1. Il consenso all’utilizzo dei cookie di profilazione viene prestato in modalità espressa
e libera dall’utente selezionando l’apposito tasto dal banner contenente l’informativa
breve o mediante l’apposita sezione di gestione delle preferenze.
                        </p>
                        <p>
                            <strong>7. Revoca del consenso all’utilizzo dei cookie</strong>
                        </p>
                        <p>
                        7.1. I cookie possono essere completamente disattivati dal browser utilizzando
l’apposita funzione prevista nella maggior parte dei programmi di navigazione; in tal
caso alcune delle funzionalità di Willfeed potrebbero non essere utilizzabili.
                        </p>
                        <p>
                        7.2. Con riferimento ai cookie di profilazione finalizzati ad offrire all’utente pubblicità
personalizzata, si informa che anche in caso di revoca del consenso, l’utente continuerà
in ogni caso a ricevere pubblicità di tipo generico.
                        </p>
                        <p>
                        7.3. Per esercitare la revoca del consenso e disattivare gli annunci pubblicitari
personalizzati occorre entrare nell’area riservata e modificare le preferenze sulla raccolta
dati.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</main>

@include('_partials/_front/footer')


@endsection

<!-- Scripts Starts -->
@section('footer-script')
<script src="{{asset('assets/front/plugins/uikit-3.16.22/js/uikit.min.js')}}"></script>
<script src="{{asset('assets/front/js/jquery-3.7.0.js')}}"></script>
<script src="{{asset('assets/front/js/custom.js?version=1')}}"></script>
@endsection
<!-- Scripts Ends -->