@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/landing')

@section('title', 'FAQs')


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
<link rel="stylesheet" href="{{asset('assets/front/css/layout/header.css')}}" />
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
                    @include('_partials/_front/_support-sidebar')
                </div>
                <div class="uk-width-expand support__col support__col--content">
                    <h1 class="title title--xl support__maintitle">FAQs</h1>
                    <div class="support__text">
                        <ul data-uk-accordion>
                            <li>
                                <a class="uk-accordion-title" href="#">COME FACCIO AD EFFETTUARE UN ORDINE?</a>
                                <div class="uk-accordion-content">
                                    <p>Per effettuare un ordine di qualsiasi prodotto presente nella piattaforma è necessario iscriversi e creare il proprio profilo. <a href="{{route("register")}}">Crea subito il tuo profilo</a></p>
                                    <p>una volta effettuata la registrazione il tuo profilo verrà convalidato dall’amministrazione WILLFEED solo dopo aver verificato che rispecchi i requisiti richiesti. 
                                    Questa procedura viene effettuata a tutti i nuovi iscritti per garantire la massima sicurezza e autenticità per le parti che interagiscono nella nostra community. Leggi qui i nostri <a href="{{route("pages-terms")}}">termini e condizioni</a>.</p>
                                    <p>Appena ricevi l’email di avvenuta conferma di iscrizione da parte di WILLFEED puoi accedere  alla piattaforma e andare nella sezione market, all’interno della quale puoi cercare i prodotti che ti interessano.</p>
                                    <p>Una volta individuato il prodotto che soddisfa le tue richieste clicca sul tasto "collabora", ciò ti permette di inviare una richiesta di collaborazione al fornitore. 
                                    Il fornitore riceve la tua richiesta e se la ritiene opportuna accetta, una volta che il fornitore accetta la tua richiesta ricevi un fido che potrai sfruttare per effettuare gli ordini esclusivamente per questo fornitore. 
                                    Puoi monitorare la rimanenza del tuo fido e dei tuoi ordini nella sezione dashboard nella tua area personale.</p>
                                </div>
                            </li>
                            <li>
                                <a class="uk-accordion-title" href="#">COME FACCIO AD INSERIRE UN PRODOTTO CHE NON HO NELLA LISTA? </a>
                                <div class="uk-accordion-content">
                                    <p>Per inserire un prodotto non presente nella lista prodotti che puoi vendere, basta inviare una mail nella sezione contatti di WILLFEED.</p>
                                    <p>E’ necessario che indichi la tipologia del prodotto che desideri vendere e allegare le specifiche tecniche del prodotto.</p>
                                    <p>L'amministrazione WILLFEED una volta ricevuta la tua richiesta valuterà il prodotto ed esaminerà le specifiche tecniche di quest’ultimo. Se rispecchia i <a href="{{route("pages-terms")}}">Termini e condizioni</a> della piattaforma riceverai una notifica di avvenuta accettazione e troverai il tuo prodotto richiesto nella lista prodotti nella tua area personale.</p>
                                </div>
                            </li>
                            <li>
                                <a class="uk-accordion-title" href="#">COME FACCIO A TROVARE  NUOVI CLIENTI?</a>
                                <div class="uk-accordion-content">
                                    <p>Per aumentare il tuo volume di affare puoi accedere alla sezione vendite, fatto ciò puoi cercare analizzare e valutare ogni singolo cliente presente sulla piattaforma.</p>
                                    <p>Per facilitare la ricerca puoi utilizzare i filtri di ricerca che ti permettono di trovare il cliente con varie specifiche, come ad esempio: per regione, per prodotto, per modalità di pagamento, per dilazione di pagamento ecc…</p>
                                    <p>una volta individuato un potenziale cliente, puoi cliccare sul suo profilo e scaricare i documenti necessari per effettuare l’affidamento. Puoi scaricare la  visura camerale aggiornata, documento di riconoscimento dell’amministratore, e documentazione relativa all’esenzione dell'Iva se il cliente ne beneficia.</p>
                                    <p>effettuati i tuoi controlli puoi inviare il tuo fido  indicando il valore in euro che riceverà il cliente e potrà usufruirne per eventuali ordini.</p>
                                    <p>puoi monitorare la tua lista clienti nella tua area personale, inoltre puoi tenere sotto controllo anche i relativi fidi per ogni singolo cliente.</p>
                                </div>
                            </li>
                            <li>
                                <a class="uk-accordion-title" href="#">COME FACCIO AD INVIARE UNA NOTA SPECIFICA RELATIVA AD UN ORDINE?</a>
                                <div class="uk-accordion-content">
                                    <p>Quando effettui un ordine o ricevi un ordine, oltre al quantitativo di litri richiesto e la dilazione e modalità di pagamento scelta puoi aggiungere una nota specifica che il fornitore o il cliente  leggerà appena subito riceva la tua richiesta di ordine.</p>
                                    <p>Le note hanno la funzione di inviare messaggi rapidi e specifici per evitare inconvenienti, come ad esempio puoi scrivere nella nota:</p>
                                    <p>ex. preferibile consegnare entro le 10 di mattina<br>
                                        arrivati a destinazione bussare al citofono xxxx<br>
                                        preferibile avere un campione di prova prima di effettuare lo scarico<br>
                                        lasciare titolo allo scarico all’autista<br>
                                        lasciare numero di telefono addetto allo scarico<br>
                                    </p>
                                    <p>Tieni sempre sotto controllo le note relativi agli ordini questo passaggio è fondamentale per garantire un perfetto funzionamento del servizio ed eventuale tracciamento per richiedere un assistenza istantanea.</p>
                                </div>
                            </li>
                            <li>
                                <a class="uk-accordion-title" href="#">COSA SONO I FEEDACK?</a>
                                <div class="uk-accordion-content">
                                    <p>I feedback che puoi trovare sotto forma di stelline sui profili dei venditori o dei clienti sono uno strumento utile a classificare velocemente un utente nella piattaforma e garantire una community che interagisce su due principi fondamentali trasparenza e confronto sia che sei un venditore o un cliente puoi dare una valutazione in maniera completamente anonima ad un utente con cui collabori.</p>
                                    <p>Durante la tua attività lavorativa qui su WILLFEED possono accadere alcuni eventi piacevoli o spiacevoli con alcuni clienti o fornitori e in base a ciò che accade puoi dare una valutazione rispettando sempre un principio di verità e rispetto per la community.</p>
                                    <p>Ad esempio se un tuo cliente è un cattivo pagatore oppure poco professionale in alcuni atteggiamenti puoi dare una valutazione da 1 a 5 e motivare con un messaggio che l’amministrazione avrà il compito di prenderne atto.</p>
                                    <p>Stesso vale per i clienti che possono avere avuto degli inconvenienti con alcuni fornitori relativi ad esempio alla qualità del prodotto oppure a ritardi relativi alle consegne e di conseguenza può dare una valutazione da 1 a 5 e motivare con un messaggio che l’amministrazione avrà il compito di prenderne atto.</p>
                                    <p>Non sarà quindi possibile effettuare valutazioni fittizie poiché tutti i feedback saranno accertati dall’amministrazione WILLFEED che ne prenderà nota e si accetterà dell’autenticità di queste valutazioni.</p>
                                </div>
                            </li>
                            <li>
                                <a class="uk-accordion-title" href="#">COME FACCIO A CERCARE NUOVI FORNITORI?</a>
                                <div class="uk-accordion-content">
                                    <p>Dopo esserti iscritto alla piattaforma nella <a href="{{route("register")}}">pagina di iscrizione</a> vai nella sezione market,e in questa sezione potrai cercare i tuoi nuovi fornitori.<br> 
                                    Troverai in tempo reale i prezzi dei prodotti pubblicati dai venditori operativi sulla piattaforma, puoi utilizzare anche il sistema di ricerca che ti permette di cercare i prodotti per prezzo, dilazione, metodo di pagamento e per regione.</p>
                                    <p>Individuato il prodotto e il fornitore clicca sul tasto collabora, questo ti permetterà di inviare una richiesta di collaborazione che riceverà il fornitore.<br>
                                        Una volta ricevuta la tua richiesta di collaborazione il fornitore può accettare o rifiutare la tua richiesta. Se viene accettata ricevi un fido in euro che equivale all’ammontare spendibile esclusivamente per quel fornitore.<br>
                                        Puoi monitorare lo stato dei tuoi fidi nella tua area personale.
                                        </p>
                                </div>
                            </li>
                            <li>
                                <a class="uk-accordion-title" href="#">COME FACCIO MONITORARE LO STATO DEI MIEI ORDINI?</a>
                                <div class="uk-accordion-content">
                                    <p>Puoi monitorare lo stato dei tuoi ordini nella tua area personale, all’interno della quale puoi trovare la sezione dedicata agli ordini.</p>
                                    <p>Una volta cliccato sulla sezione ordine puoi monitorare lo stato dell’ordine. Hai la possibilità di vedere l’avanzamento dell’ordine dal momento in cui viene inviato, confermato e consegnato, infine se l’ordine è stato effettuato con una modalità di pagamento dilazionata l’ordine risulterà non pagato fino a quella data.</p>
                                    <p>La piattaforma ti invierà un avviso per i pagamenti imminente in modo tale da tenere sotto controllo tutte le scadenze, solo successivamente all’avvenuto pagamento lo sto dell’ordine risulterà pagato.</p>
                                </div>
                            </li>
                            <li>
                                <a class="uk-accordion-title" href="#">NON HANNO CONSEGNATO L’ORDINE RICHIESTO COSA FACCIO?</a>
                                <div class="uk-accordion-content">
                                    <p>Se il tuo ordine è stato confermato ma non ancora consegnato rispetto alla data prevista, puoi contattare direttamente il tuo fornitore cliccando sul suo profilo e metterti in contatto telefonicamente per velocizzare i tempi.</p>
                                    <p>Se il fornitore risulta irraggiungibile puoi contattare l'amministrazione WILLFEED nella sezione <a href="{{route('pages-contactus')}}">Contatti</a> saremo a tua completa disposizione per aiutarti a risolvere qualsiasi imprevisto</p>
                                </div>
                            </li>
                        </ul>
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
<script src="{{asset('assets/front/js/custom.js')}}"></script>
@endsection
<!-- Scripts Ends -->