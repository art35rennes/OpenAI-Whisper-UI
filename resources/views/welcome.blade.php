@extends("layout")
@section("title")OpenAI Whisper UI @endsection
@section("body")
    <div class="container p-4">
        <h1>OpenAI Whisper</h1>
        <p class="lead">Transférer le fichier audio à transcrire</p>

        <form name="transcription" method="post" enctype="multipart/form-data" action="{{route("whisper.post")}}">
            @csrf
            <div class="row gx-2">
                <div class="col-md-3 col-sm-12 border rounded-5 py-2 px-4 my-1 mx-1">
                    <h7>Paramètre de trasncription</h7>
                    <div class="input-group">
                        <div id="langue-origine-autocomplete" class="form-outline langue-autocomplete my-2 w-100">
                            <input type="search" id="form1" name="origine-audio" class="form-control"/>
                            <label class="form-label" for="form1">Langue du fichier audio</label>
                        </div>
                    </div>
                    <div class="input-group">
                        <div id="langue-target-autocomplete" class="form-outline langue-autocomplete my-2 w-100">
                            <input type="search" id="form2" name="target-audio" class="form-control"/>
                            <label class="form-label" for="form2">Langue de la transcription</label>
                        </div>
                    </div>
                    <hr>
                    <select class="select" name="model">
                        <option value="tiny">Tiny</option>
                        <option value="base">Base</option>
                        <option value="small" selected>Small</option>
                        <option value="medium">Medium</option>
                        <option value="large">Large</option>
                    </select>
                    <label class="form-label select-label">Model</label>
                    <div class="d-flex align-items-center justify-content-center my-2" style="height: 100px;">
                        <button class="btn btn-success btn-rounded">Lancer la transcription</button>
                    </div>

                </div>

                <div class="col-md-8 col-sm-12 border rounded-5 py-5 px-2 my-1 mx-1">
                    <div id="dnd-accept-formats" class="file-upload-wrapper w-100 h-100">
                        <input
                            type="file"
                            name="audio-file"
                            class="file-upload-input"
                            data-mdb-accepted-extensions="audio/*"
                            data-mdb-file-upload="file-upload"
                            data-mdb-default-msg="Ajouter votre fichier audio"
                        />
                    </div>
                </div>
            </div>
        </form>

        <div class="col-11 mt-5">
            <h7>Historique des transcriptions</h7>
            <div class="form-outline mb-4">
                <input type="text" class="form-control" id="datatable-search-input" />
                <label class="form-label" for="datatable-search-input">Rechercher</label>
            </div>
            <div id="datatable" data-mdb-selectable="true" data-mdb-multi="true"></div>
        </div>


    </div>
@endsection

@section("js")
    <script type="text/javascript">

        // SEARCH
        const origineAutocomplete = document.querySelector('#langue-origine-autocomplete');
        const targetAutocomplete = document.querySelector('#langue-target-autocomplete');
        const data = [
            'af: Afrikaans',
            'am: Amharic',
            'ar: Arabic',
            'as: Assamese',
            'az: Azerbaijani',
            'ba: Bashkir',
            'be: Belarusian',
            'bg: Bulgarian',
            'bn: Bengali',
            'bo: Tibetan',
            'br: Breton',
            'bs: Bosnian',
            'ca: Catalan',
            'cs: Czech',
            'cy: Welsh',
            'da: Danish',
            'de: German',
            'el: Greek',
            'en: English',
            'es: Spanish',
            'et: Estonian',
            'eu: Basque',
            'fa: Persian',
            'fi: Finnish',
            'fo: Faroese',
            'fr: French',
            'gl: Galician',
            'gu: Gujarati',
            'ha: Hausa',
            'haw: Hawaiian',
            'hi: Hindi',
            'hr: Croatian',
            'ht: Haitian Creole',
            'hu: Hungarian',
            'hy: Armenian',
            'id: Indonesian',
            'is: Icelandic',
            'it: Italian',
            'iw: Hebrew',
            'ja: Japanese',
            'jw: Javanese',
            'ka: Georgian',
            'kk: Kazakh',
            'km: Khmer',
            'kn: Kannada',
            'ko: Korean',
            'la: Latin',
            'lb: Luxembourgish',
            'ln: Lingala',
            'lo: Lao',
            'lt: Lithuanian',
            'lv: Latvian',
            'mg: Malagasy',
            'mi: Maori',
            'mk: Macedonian',
            'ml: Malayalam',
            'mn: Mongolian',
            'mr: Marathi',
            'ms: Malay',
            'mt: Maltese',
            'my: Myanmar',
            'ne: Nepali',
            'nl: Dutch',
            'nn: Nynorsk',
            'no: Norwegian',
            'oc: Occitan',
            'pa: Punjabi',
            'pl: Polish',
            'ps: Pashto',
            'pt: Portuguese',
            'ro: Romanian',
            'ru: Russian',
            'sa: Sanskrit',
            'sd: Sindhi',
            'si: Sinhala',
            'sk: Slovak',
            'sl: Slovenian',
            'sn: Shona',
            'so: Somali',
            'sq: Albanian',
            'sr: Serbian',
            'su: Sundanese',
            'sv: Swedish',
            'sw: Swahili',
            'ta: Tamil',
            'te: Telugu',
            'tg: Tajik',
            'th: Thai',
            'tk: Turkmen',
            'tl: Tagalog',
            'tr: Turkish',
            'tt: Tatar',
            'uk: Ukrainian',
            'ur: Urdu',
            'uz: Uzbek',
            'vi: Vietnamese',
            'yi: Yiddish',
            'yo: Yoruba',
            'zh: Chinese',
        ];
        const dataFilter = (value) => {
            return data.filter((item) => {
                return item.toLowerCase().startsWith(value.toLowerCase());
            });
        };
        new mdb.Autocomplete(origineAutocomplete, {
            filter: dataFilter
        });
        new mdb.Autocomplete(targetAutocomplete, {
            filter: dataFilter
        });

        // DATATABLE
        const datas = {
            columns: [
                'Fichier',
                'Date',
                'Durée',
                'Action',
            ],

        };

        const instance = new mdb.Datatable(document.getElementById('datatable'), datas)
        document.getElementById('datatable-search-input').addEventListener('input', (e) => {
            instance.search(e.target.value);
        });

    </script>
@endsection
