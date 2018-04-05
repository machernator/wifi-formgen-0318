<?php
namespace Formgen;

class Checkbox extends Input {
    private $checked = '';

    public function __construct(string $name, array $fieldConf) {
        parent::__construct($name, $fieldConf);

        if (array_key_exists('checked', $fieldConf)) {
            $this->checked = ' checked';
        }
    }

    /**
     * Rendering von input und error
     *
     * @return string
     */
    public function render() : string {
        // Input rendern
        $out = $this->renderField();
        // Error rendern

        return $out;
    }

    /**
     * Override renderLabel - da renderField den Label ausgibt, geben wir hier einen
     * Leerstring zurück.
     *
     * @return string
     */
    public function renderLabel() : string {
        return '';
    }

    /**
     * Override der renderField Klasse. Rendert eine Checkbox
     *
     * @return string
     */
    public function renderField() : string {
        $out = '<label for="' . $this->id . '">';                
                
        $out .= '<input type="checkbox" ' .
        'name="' . $this->name . '" ' .
        'value="' . $this->value . '" ' .
        'id="' . $this->id . '"'.
        $this->checked;
        
        // Tag Attributes
        $out .= $this->renderTagAttributes();
        
        // Tag schließen
        $out .= '>&nbsp;' .
        $this->label . 
        '</label>';

        return $out;
    }

    /**
     * Checkboxes sind speziell - es wird kein Value gesendet, wenn diese
     * nicht gechecked sind. Entspricht $value dem value der Konfiguration,
     * wird die checkbox checked gesetzt.
     *
     * @param mixed $val
     * @return void
     */
    public function setValue($value) {
        if ($value != $this->value) {
            $this->checked = '';
        }
        else {
            $this->checked = ' checked';
        }
    }
}