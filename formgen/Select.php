<?php
namespace Formgen;

class Select extends Input {
    protected $options = [];

    public function __construct(string $name, array $fieldConf) {
        // Bei Überschreiben des Konstruktors muss der Parent Konstruktor manuell aufgerufen werden
        parent::__construct($name, $fieldConf);

        // Options auf Gültigkeit überprüfen
        if (!array_key_exists('options', $fieldConf) || 
            !is_array($fieldConf['options']) || 
            empty($fieldConf['options'])
            ) {
            die($this->name . ' options not defined');
        }

        $this->options = $fieldConf['options'];

        // value kann array oder string sein
        $this->value = [];

        if (array_key_exists('value', $fieldConf)){
            // wenn array: einfach zuweisen
            if (is_array($fieldConf['value'])) {
                $this->value = $fieldConf['value'];
            }
            // wenn string: string in array kapseln
            elseif (is_string($fieldConf['value'])) {
                $this->value = [ $fieldConf['value'] ];
            }
        }
    }

    /**
     * Override renderField mit speziellen Select Optionen
     *
     * @return string
     */
    public function renderField() : string {
        $out = '<select name="' . $this->name . '" '.
                'id="' . $this->id . '"'.
                $this->renderTagAttributes() .
                '>';

        // Options ausgeben
        $out .= $this->renderOptions();

        $out .= '</select>';
        return $out;
    }

    /**
     * Rendering der Select Options
     *
     * @return string
     */
    public function renderOptions() : string {
        $out = '';

        foreach ($this->options as $val => $text) {
            $out .= '<option value="' . $val . '"';
            
            // selected?
            if( (is_array($this->value) && in_array($val, $this->value)) || $val === $this->value ) {
                $out .= ' selected';
            }

            $out .= '>' . $text . '</option>';
        }
        return $out;
    }
}