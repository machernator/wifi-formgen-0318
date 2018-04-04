<?php
namespace Formgen;

class Submit extends Input {
    public function renderLabel() : string {
        return '';
    }

    public function render() : string {
        $out = '<input type="submit" ' .
                'id="' . $this->id . '"' .
                $this->renderTagAttributes() .
                ' value="' . $this->value . '">';
        return $out;
    }
}