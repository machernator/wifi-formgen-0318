<?php
namespace Formgen;

class Reset extends Input {
    public function rendeLabel() {
        return '';
    }

    public function render() : string {
        $out = '<input type="reset" ' .
                'id="' . $this->id . '"' .
                $this->renderTagAttributes() .
                ' value="' . $this->value . '">';

        return $out;
    }
}