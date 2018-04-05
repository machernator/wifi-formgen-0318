<?php
namespace Formgen;

/**
 * Form rendert das gesamte Formular, erlaubt aber auch Zugriff auf jedes 
 * einzelne Formularfeld und seine Komponenten.
 * 
 */
class Form {
    private $action = '';
    private $method = 'post';
    private $id = '';
    private $fields = [];
    private $tagAttributes = [];

    /**
     * Form und Formfelder initialisieren
     *
     * @param array $formConfig
     */
    public function __construct(array $formConfig) {
        $myConf = $formConfig['form'];
        // Form initialisieren
        if (array_key_exists('action', $myConf)) {
            $this->action = $myConf['action'];
        }

        if (array_key_exists('method', $myConf) && strtolower($myConf['method']) === 'get') {
            $this->method = 'get';
        }

        if (array_key_exists('id', $myConf)) {
            $this->id = $myConf['id'];
        }

        /*
            Wenn errorClass gesetzt wurde, kann, falls nicht vorhanden, diese 
            Klasse jedem Feld zugeordnet werden. Hat das Feld schon eine
            errorClass, bleibt diese erhalten.
         */
        if (array_key_exists('errorClass', $myConf)) {
            foreach ($formConfig['fields'] as $name => $field) {
                if (!array_key_exists('errorClass', $field)) {
                    $formConfig['fields'][$name]['errorClass'] = $myConf['errorClass'];
                }
            }
        }
        
        // Fields erstellen
        if (array_key_exists('fields', $formConfig) &&
            is_array($formConfig['fields']) &&
            !empty($formConfig['fields'])) {
            $this->createFields($formConfig['fields']);
        }
        else {
            die('Formconfiguation Error: no fields');
        }

        // tagattributes optional
        if (array_key_exists('tagAttributes', $myConf) && 
            is_array($myConf['tagAttributes'])) {
            $this->tagAttributes = $myConf['tagAttributes']; 
        }
    }

    public function render() : string {
        return $this->renderOpenTag() .
                $this->renderFields() .
                $this->renderCloseTag();
    } 

    public function renderOpenTag() : string {
        $out = '<form action="' . $this->action . '" ' .
                'id="' . $this->id . '" ' .
                'method="' . $this->method . '"' .
                $this->renderTagAttributes() .
                '>';
        return $out;
   }

    public function renderCloseTag() : string {
        return '</form>';
    }

    /**
     * Rendering aller Formularfelder
     *
     * @return string
     */
    public function renderFields() : string {
        $out = '';
        foreach ($this->fields as $field) {
            $out .= $field->render();
        }

        return $out;
    }

    public function renderField(string $name) : string {

    }

    /**
     * Erzeugt Input Felder anhand des Typs in der Konfiguration
     *
     * @param array $conf
     * @return void
     */
    private function createFields(array $conf) {
        // Schleife über alle Fields, Name und Konfiguation auslesen
        foreach ($conf as $name => $fieldConf) {
            // Erzeuge Felder anhand des type Attributes
            switch ($conf[$name]['type']) {
                case 'checkbox':
                    $this->fields[$name] = new Checkbox($name, $fieldConf);
                    break;
                case 'textarea':
                    $this->fields[$name] = new Textarea($name, $fieldConf);
                    break;
                case 'radio':
                    $this->fields[$name] = new Radio($name, $fieldConf);
                    break;
                case 'select':
                    $this->fields[$name] = new Select($name, $fieldConf);
                    break;
                case 'file':
                    $this->fields[$name] = new File($name, $fieldConf);
                    break;
                case 'submit':
                    $this->fields[$name] = new Submit($name, $fieldConf);
                    break;
                case 'reset':
                    $this->fields[$name] = new Reset($name, $fieldConf);
                    break;
                default:
                    $this->fields[$name] = new Input($name, $fieldConf);
            }
        }
    }

    /**
     * Rendering der optionalen Attribute des input tags
     *
     * @return string
     */
    protected function renderTagAttributes() : string {
        $out = '';
        foreach($this->tagAttributes as $attr => $val) {
            $out .= " $attr=\"$val\"";
        }
        return $out;
    }

    /**
     * Prüfen, ob das Formular gesendet wurde
     *
     * @return boolean
     */
    public function isSent() {
        if ( $this->method === 'get') {
            return !empty($_GET);
        }
        return !empty($_POST);
    }

    /**
     * Prüft, ob die gesendeten Daten valide sind
     *
     * @return mixed    array | boolean false
     */
    public function isValid() {
        $gump = new \GUMP\GUMP();
        $validatedData = [];
        $data = [];

        $validationRules = $this->createValidationRules();
        $filterRules = $this->createFilterRules();
        
        $gump->validation_rules($validationRules);
        $gump->filter_rules($filterRules);
       
        if ($this->method === 'get'){
            $data = $_GET;
        }
        else {
            $data = $_POST;
        }

        $validatedData = $gump->run($data); 

        // Gump gibt false zurück, falls ein Fehler auftrat
        if ($validatedData === false) {
            // Fehlermeldungen ermitteln und in Felder schreiben
            $errors = $gump->get_errors_array();

            // Schleife über Validierungen, wenn Fehler in $errors, den Fehler an Feld übergeben
            foreach ($this->fields as $name => $field) {
                //$field = $this->fields[$name];
                // Wurde ein Fehler für das aktuelle Feld erzeugt?
                if (array_key_exists($name, $errors)) {
                    $field->setError($errors[$name]);
                }

                // value auf gesendeten Wert setzen
                if (array_key_exists($name, $data)) {
                    $field->setValue($data[$name]);
                }
                // Checkboxen 
                elseif ($field->getType() === 'checkbox' || $field->getType() === 'radio') {
                    $field->setValue(false);
                }
            }
            return false;
        }
        return $validatedData;
    }

    /**
     * Für GUMP die Valdidierungsregeln erzeugen
     *
     * @return void
     */
    protected function createValidationRules() {
        $rules = [];
        foreach($this->fields as $name => $field) {
            $rules[$name] = $field->getValidationRules();
        }
        return $rules;
    }

    protected function createFilterRules() {
        $rules = [];
        foreach($this->fields as $name => $field) {
            $rules[$name] = $field->getFilterRules();
        }
        return $rules;
    }

}