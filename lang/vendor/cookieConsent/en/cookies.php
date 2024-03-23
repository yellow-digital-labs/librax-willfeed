<?php
return [
    'title' => 'Hai il controllo sui tuoi cookie',
    'intro' => 'WillFeed utilizza cookies su questo sito. I cookie servono a migliorare i nostri servizi e ottimizzare l\'esperienza utente. Sono inclusi cookie di profilazione (anche di terze parti) per inviare messaggi pubblicitari mirati o personalizzare i contenuti. Usiamo cookie analitici per capire come viene utilizzato il sito e valutarne il funzionamento. Accetta tutti i cookie cliccando sul pulsante ACCETTA TUTTI oppure seleziona le tipologie.',
    'link' => 'Per maggiori informazioni consulta l\'<a href=":url">informativa sui Cookie</a>.',

    'essentials' => 'Rifiuta tutti',
    'all' => 'Accetta tutti',
    'customize' => 'Impostazioni cookies',
    'manage' => 'Gestisci i cookie',
    'details' => [
        'more' => 'Più dettagli',
        'less' => 'Less details',
    ],
    'save' => 'Save settings',

    'categories' => [
        'essentials' => [
            'title' => 'Cookie necessari',
            'description' => 'Questi cookie sono necessari per il funzionamento del sito, con particolare riferimento alla normale navigazione e alla fruizione dello stesso, e non possono essere disattivati nei nostri sistemi. Di solito vengono impostati solo in risposta alle azioni da te effettuate che costituiscono una richiesta di servizi, come l\'impostazione delle preferenze di privacy, l\'accesso o la compilazione di moduli.
            È possibile impostare il browser per bloccare questi cookie, ma di conseguenza alcune o tutte le parti del sito non funzioneranno. Questi cookie non memorizzano informazioni personali.',
        ],
        'analytics' => [
            'title' => 'Cookie analitici',
            'description' => 'Questi cookie ci permettono di contare le visite e le fonti di traffico in modo da poter valutare e migliorare le prestazioni del nostro sito. Ci aiutano a sapere quali sono le pagine più e meno popolari e vedere come i visitatori navigano sul sito. Tutte le informazioni raccolte dai cookie sono aggregate e quindi anonime.
            Se non autorizzi questi cookie, non potremo valutare la navigazione e il comportamento collettivo della nostra utenza e migliorare di conseguenza le prestazioni del sito.',
        ],
        'optional' => [
            'title' => 'Cookie di funzionalità',
            'description' => 'Questi cookie consentono al sito di fornire funzionalità e personalizzazione avanzate, che permettono la navigazione in funzione di una serie di criteri selezionati (ad esempio, la lingua, i prodotti selezionati per gli acquisti) al fine di migliorare il servizio reso. Possono essere impostati da noi o da provider di terze parti i cui servizi sono stati aggiunto alle nostre pagine.
            Se non si autorizzano questi cookie, alcuni o tutti la totalità di questi servizi potrebbero non funzionare correttamente.',
        ],
    ],

    'defaults' => [
        'consent' => 'Used to store the user\'s cookie consent preferences.',
        'session' => 'Used to identify the user\'s browsing session.',
        'csrf' => 'Used to secure both the user and our website against cross-site request forgery attacks.',
        '_ga' => 'Main cookie used by Google Analytics, enables a service to distinguish one visitor from another.',
        '_ga_ID' => 'Used by Google Analytics to persist session state.',
        '_gid' => 'Used by Google Analytics to identify the user.',
        '_gat' => 'Used by Google Analytics to throttle the request rate.',
    ],
];