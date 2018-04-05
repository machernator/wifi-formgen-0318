<?php
namespace Formgen;

class Input {
    protected $name = '';
    protected $type = '';
    protected $id = '';
    protected $value = '';
    protected $label = '';
    protected $errorClass = 'field-error';
    protected $error = '';
    protected $tagAttributes = [];
    protected $validationRules = '';
    protected $filterRules = '';

    /**
     * Konstruktor
     *
     * @param string $name
     * @param array $fieldConf
     */
    public function __construct(string $name, array $fieldConf)
    {
        // name
        $this->name = $name;

        // type
        if (!array_key_exists('type', $fieldConf) || $fieldConf['type'] === '') {
            die($this->name . ' type not defined');
        }
        $this->type = $fieldConf['type'];

        // id
        if (!array_key_exists('id', $fieldConf) || $fieldConf['id'] === '') {
            // TODO: id muss wirklich eindeutig sein
            $this->id = $this->name;
        }

        if (array_key_exists('id', $fieldConf)){
            $this->id = $fieldConf['id'];
        }

        // value optional
        if (array_key_exists('value', $fieldConf)) {
            $this->value = $fieldConf['value'];
        }

         // label optional
         if (!array_key_exists('label', $fieldConf) || $fieldConf['label'] === '') {
            $this->label = $this->name;
        }
        $this->label = $fieldConf['label'];

        // errorClass optional
        if (array_key_exists('errorClass', $fieldConf)) {
            $this->errorClass = $fieldConf['errorClass'];
        }
       
        // tagattributes optional
        if (array_key_exists('tagAttributes', $fieldConf) && is_array($fieldConf['tagAttributes'])) {
            $this->tagAttributes = $fieldConf['tagAttributes']; 
        }

        // validationRules
        if (array_key_exists('validationRules', $fieldConf)) {
            $this->validationRules = $fieldConf['validationRules']; 
        }
        
        // filterRules
        if (array_key_exists('filterRules', $fieldConf)) {
            $this->filterRules = $fieldConf['filterRules']; 
        }
    }

    /**
     * Rendering von label, input und error
     *
     * @return string
     */
    public function render() : string {
        // Label rendern
        $out = $this->renderLabel();
        // Input rendern
        $out .= $this->renderField();
        // Error rendern
        $out .= $this->renderError();

        return $out;
    }

    /**
     * Rendering des label tags
     *
     * @return string
     */
    public function renderLabel() : string {
        $out = '<label for="' . $this->id . '">' .
                $this->label .
                '</label>';
        return $out;
    }

    /**
     * Rendering des input Feldes
     *
     * @return string
     */
    public function renderField() : string {
        $out = '<input type="' . $this->type . '" ' .
                'name="' . $this->name . '" ' .
                'value="' . $this->value . '" ' .
                'id="' . $this->id . '"';

        // Tag Attributes
        $out .= $this->renderTagAttributes();
        // Tag schließen
        $out .= '>';
        return $out;
    }

    /**
     * Ausgabe der Fehlermeldung. 
     *
     * @return void
     */
    public function renderError() {
        if ($this->error !== '') {
            return '<span class="' . $this->errorClass . '">' . $this->error . '</span>';
        }
        return '';
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
     * Validationrules zur Verfügung stellen
     *
     * @return void
     */
    public function getValidationRules() {
        return $this->validationRules;
    }
    
    /**
     * Filterrules zur Verfügung stellen
     *
     * @return void
     */
    public function getFilterRules() {
        return $this->filterRules;
    }
    
    /**
     * Fehlermeldung setzen
     *
     * @param string $error
     * @return void
     */
    public function setError(string $error) {
        $this->error = $error;
    }

    /**
     * Value setzen
     *
     * @param mixed $value
     * @return void
     */
    public function setValue($value) {
        $this->value = $value;
    }

    /**
     * Type ermitteln
     *
     * @return string
     */
    public function getType() : string {
        return $this->type;
    }
}