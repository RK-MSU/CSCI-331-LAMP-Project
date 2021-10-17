<?php

$field_attrs = '';

if(isset($placeholder) && !empty($placeholder)) {
    $field_attrs .= " placeholder=\"${placeholder}\"";
}

if(isset($attrs) && !empty($attrs)) {
    if(gettype($attrs) == 'array') {
        foreach($attrs as $attr_key => $attr_val) {
            $field_attrs .= " ${attr_key}=\"${attr_val}\"";
        }
    } else if (gettype($attrs) == 'string') {
        $field_attrs .= " ${attrs}";
    }
}

if(isset($required) && $required) {
    $field_attrs .= ' required';
}

$field_attrs = trim($field_attrs, ' ');

?>
<input type="<?=$type?>" name="<?=$name?>" value="<?php if(isset($value)) echo $value; ?>" class="form-control" <?php if(isset($field_attrs) && !empty($field_attrs)) echo $field_attrs;?>>