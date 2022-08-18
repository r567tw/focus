<?php
namespace r567tw\phpmvc\form;

use r567tw\phpmvc\Model;

class Field extends BaseField
{
    const TYPE_TEXT = 'text';
    const TYPE_TEXTAREA = 'textarea';
    const TYPE_PASSWORD = 'password';
    const TYPE_FILE = 'file';
    const TYPE_EMAIL = 'email';

    public Model $model;
    public string $attribute;
    public string $type;
    public string $label;

    public function __construct(Model $model,string $label,string $attribute)
    {
        $this->model = $model;
        $this->label = $label;
        $this->attribute = $attribute;
        $this->type = self::TYPE_TEXT;
    }

    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function emailField()
    {
        $this->type = self::TYPE_EMAIL;
        return $this;
    }

    public function renderInput()
    {
        return sprintf(
            '<input type="%s" class="form-control%s" name="%s" value="%s">',
            $this->type,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->attribute,
            $this->model->{$this->attribute},
        );
    }
    
}
