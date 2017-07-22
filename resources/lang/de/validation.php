<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute muss aktzeptiert werden.',
    'active_url'           => ':attribute ist keine gültige URL.',
    'after'                => ':attribute muss ein Datum nach dem :date sein.',
    'after_or_equal'       => ':attribute muss ein Datum nach oder gleich diesem Datum sein :date.',
    'alpha'                => ':attribute darf nur Buchstaben enthalten.',
    'alpha_dash'           => ':attribute darf nur Buchstaben, Nummern und Slashes enthalten.',
    'alpha_num'            => ':attribute darf nur Buchstaben und Nummern enthalten',
    'array'                => ':attribute muss ein Array sein.',
    'before'               => ':attribute muss ein Datum vor dem :date sein.',
    'before_or_equal'      => ':attribute muss ein Datum vor oder gleich diesem Datum sein :date.',
    'between'              => [
        'numeric' => ':attribute muss zwischen :min und :max sein.',
        'file'    => ':attribute muss zwischen :min KB und :max KB groß sein.',
        'string'  => ':attribute muss zwischen :min und :max Zeichen enthalten.',
        'array'   => ':attribute muss zwischen :min und :max Objekte enthalten.',
    ],
    'boolean'              => ':attribute muss "true" oder "false" sein.',
    'confirmed'            => ':attribute ist nicht gültig.',
    'date'                 => ':attribute ist kein gültiges Datum.',
    'date_format'          => ':attribute entspricht nicht dem Format: :format.',
    'different'            => ':attribute und :other müssen sich unterscheiden.',
    'digits'               => ':attribute muss :digits Ziffern lang sein.',
    'digits_between'       => ':attribute muss zwischen den Ziffern :min und :max liegen.',
    'dimensions'           => ':attribute eine ungültige Bild größe.', 
    'distinct'             => ':attribute Feld hat einen doppelten Wert.',
    'email'                => ':attribute muss eine gültige E-Mail sein.',
    'exists'               => ':attribute ist ungültig.',
    'file'                 => ':attribute muss eine Datei sein.',
    'filled'               => ':attribute Feld muss einen Wert haben.',
    'image'                => ':attribute muss ein Bild sein.',
    'in'                   => ':attribute ist ungültig.',
    'in_array'             => ':attribute existiert nicht in :other.',
    'integer'              => ':attribute muss ein Integer sein.',
    'ip'                   => ':attribute muss eine gültige IP-Adresse sein.',
    'json'                 => ':attribute muss ein gültiger JSON-String sein.',
    'max'                  => [
        'numeric' => ':attribute darf nicht größer sein als :max.',
        'file'    => ':attribute darf nicht größer sein als :max KB.',
        'string'  => ':attribute darf nicht länger sein als :max Zeichen',
        'array'   => ':attribute darf nicht mehr als :max Objekte enthalten',
    ],
    'mimes'                => ':attribute muss vom folgender Datei-Typ sein: :values.', 
    'mimetypes'            => ':attribute muss vom folgender Datei-Typ sein: :values.',
    'min'                  => [
        'numeric' => ':attribute muss mindestens :min lang sein.', 
        'file'    => ':attribute muss mindestens :min KB groß sein.',
        'string'  => ':attribute muss mindestens :min Zeichen lang sein.',
        'array'   => ':attribute muss mindestens :min Objekte enthalten.',
    ],
    'not_in'               => ':attribute ist ungültig.',
    'numeric'              => ':attribute muss eine Nummer sein.',
    'present'              => ':attribute Feld muss aktuell sein.',
    'regex'                => ':attribute Format ist ungültig.',
    'required'             => ':attribute ist erforderlich.',
    'required_if'          => ':attribute ist erforderlich, wenn :other gleich :value ist.', 
    'required_unless'      => ':attribute ist erforderlich, solange :other in :values vorhanden ist.',
    'required_with'        => ':attribute ist erforderlich, wenn :values vorhanden ist.',
    'required_with_all'    => ':attribute ist erforderlich, wenn :values vorhadnen ist.',
    'required_without'     => ':attribute ist erforderlich, wenn :values nicht vorhanden ist.',
    'required_without_all' => ':attribute ist erforderlich, wenn :values nicht vorhanden sind.',
    'same'                 => ':attribute und :other müssen übereinstimmen.',
    'size'                 => [
        'numeric' => ':attribute muss :size groß sein.',
        'file'    => ':attribute muss :size KB groß sein.',
        'string'  => ':attribute muss :size Zeichen lang sein.',
        'array'   => ':attribute muss :size Objekte enthalten.',
    ],
    'string'               => ':attribute muss ein String sein.',
    'timezone'             => ':attribute muss eine gültige Zeitzone sein.',
    'unique'               => ':attribute ist schon vorhanden.',
    'uploaded'             => ':attribute wurde nicht erfolgreich hochgeladen.',
    'url'                  => ':attribute Format ist ungültig.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message','persönliche Nachricht',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
