<?php
namespace Formgen;

class Textarea extends Input {
    /**
     * Override der renderField Klasse. Rendert eine Textarea
     *
     * @return string
     */
    public function renderField() : string {
        $out = '<textarea ' .
                'name="' . $this->name . '" ' .
                'id="' . $this->id . '"';
        
        // Tag Attributes
        $out .= $this->renderTagAttributes();
        // Tag schließen
        $out .= '>';
        $out .= $this->value;
        $out .= '</textarea>';

        return $out;
    }
}