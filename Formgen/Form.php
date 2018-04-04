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
       

    }

    public function render() : string {

    }

    public function renderOpenTag() : string {

    }

    public function renderCloseTag() : string {
        return '</form>';
    }

    public function renderFields() : string {

    }

    public function renderField(string $name) : string {

    }

}