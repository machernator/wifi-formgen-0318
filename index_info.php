<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Generator</title>
</head>
<body>
    <!-- 
        <label for="$id">$Labeltext</label>
        <input type="$type" $name $id $value $class $title $etc.> 
    -->
    <?php
        $conf = [
            'vorname' => [
                'type' => 'text',
                'id' => 'feldVorname',
                'value' => 'blabla',
                'label' => 'Vorname',
                'tagAttributes' => [
                    'class' => 'form-field',
                    'title' => 'Ihr Vorname',
                    'placeholder' => 'Vorname'
                ]
            ],
            'nachname' => [
                'type' => 'text',
                'id' => 'feldNachname',
                'value' => 'bliblbi',
                'label' => 'Nachname',
                'tagAttributes' => [
                    'class' => 'form-field',
                    'title' => 'Ihr Nachname',
                    'placeholder' => 'Nachname'
                ]
            ]
            ,
            'email' => [
                'type' => 'email',
                'id' => 'feldEmail',
                'value' => '',
                'label' => 'E-Mail',
                'tagAttributes' => []
            ],
            'newsletter' => [
                'type' => 'checkbox',
                'id' => 'feldNewsletter',
                'value' => '1',
                'label' => 'Newsletter',
                'tagAttributes' => [
                    'class' => 'form-field',
                    'title' => 'Ihre Newsletter',
                    'placeholder' => 'Newsletter'
                ]
            ]
        ];
        
        $out = '';
        // Schleife über Konfiguration 
        foreach ($conf as $key => $value){
            $out .= '<label for="' . $conf[$key]['id'] . '">' .
                    $conf[$key]['label'] . "</label>\n"; 
            
            $out .= '<input type="' . $conf[$key]['type'] . '" ' .
                    'name="' . $key . '" ' .
                    'value="' . $conf[$key]['value'] . '" ' .
                    'id="' . $conf[$key]['id'] . '"';
            
            foreach($conf[$key]['tagAttributes'] as $attr => $attrValue) {
                $out .= ' ' . $attr . 
                        '="' . $attrValue . '"';
            }
            $out .= '>';
        }
        
        echo $out;
    ?>

</body>
</html>