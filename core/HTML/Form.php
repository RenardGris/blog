<?php

namespace Core\HTML;

/**
 * Class Form
 * generate html for forms
 *
 */
class Form
{

    protected $data;
    public $surround = 'p';

    public function __construct($data = [])
    {
        $this->data = $data;
    }

    /**
     *
     * surround the $html param with the value of surround property
     *
     * @param string $html
     * @return string
     */
    protected function surround($html)
    {
        return "<{$this->surround}> $html </{$this->surround}>";
    }

    /**
     *
     * generate input for forms
     *
     * @param string $name
     * @param string $label
     * @param array $option
     * @return string
     */
    public function input($name, $label, $option = [])
    {
        $type = isset($option['type']) ? $option['type'] : 'text';

        return $this->surround(
            '<input
                type="' . $type . '" name="' . $name . '"
                value="' . $this->getValue($name) . '"
            >'
        );
    }

    /**
     * return the selected value from a select input in forms
     *
     * @param string $index
     * @return mixed|null
     */
    protected function getValue($index)
    {

        if (is_object($this->data)) {
            return $this->data->$index;
        }

        return isset($this->data[$index]) ? $this->data[$index] : null;

    }

    /**
     *
     * Generate submit button for forms
     *
     * @param string $name
     * @return string
     */
    public function submit($name)
    {
        return $this->surround('<button type="submit">'. $name .'</button>');
    }

}
