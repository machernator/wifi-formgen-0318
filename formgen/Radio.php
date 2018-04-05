<?php
namespace Formgen;

class Radio extends Input {
    /* 
        assoziatives Array. Key ist value, value ist label des Radio Elements
        [
            "w" => "Wien",
            "n" => "Niederösterreich",
            "b" => "Burgenland"
        ]
    */
    private $values = [];

    public function __construct(string $name, array $fieldConf) {
        parent::__construct($name, $fieldConf);

        // values auf Gültigkeit überprüfen
        if (!array_key_exists('values', $fieldConf) || 
            !is_array($fieldConf['values']) || 
            empty($fieldConf['values'])
            ) {
            die($this->name . ' values not defined');
        }

        $this->values = $fieldConf['values'];

        // vorausgewählter Wert
        if (array_key_exists('value', $fieldConf)) {           
            $this->value = $fieldConf['value'];
        }
    }

    /**
     * Override renderField
     * 
     * @return string
     */
    public function renderField() : string {
        $out = '<fieldset>';
        $out .= '<legend>' . $this->label . '</legend>';
        $counter = 0;
        foreach ($this->values as $val => $text) {
            $checked = '';
            if ($this->value == $val) {
                $checked = 'checked ';
            }

            $id = $this->id . $counter;
            $out .= '<label for="' . $id .
                    '"><input type="radio" name="' .
                    $this->name . '" ' . 
                    $checked .
                    'id="' . $id . '"' .
                    $this->renderTagAttributes() .
                    ' value="' . $val . '">&nbsp' .
                    $text . 
                    '</label>';
            $counter++;
        }
        $out .= '</fieldset>';
        return $out;
    }

    /**
     * Override renderLabel
     *
     * @return string
     */
    public function renderLabel() : string {
        return '';
    }
}