<?php
namespace Formgen;

class Checkbox extends Input {

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
        'id="' . $this->id . '"';

        // Tag Attributes
        $out .= $this->renderTagAttributes();
        
        // Tag schließen
        $out .= '>&nbsp;' .
        $this->label . 
        '</label>';

        return $out;
    }
}