<?php


namespace Melogail\LaravelMetaTags;


class MetaTagsBuilder
{
    /**
     * Meta data type
     *
     * @var
     */
    protected $name;


    /**
     * Label for meta data input
     *
     * @var string
     */
    protected $label;


    /**
     * Set name to meta data
     *
     * @param $name
     * @return $this
     */
    public function name($name)
    {
        $this->name = $name;

        return $this;
    }


    /**
     * Set label to meta data input label
     *
     * @param $label
     * @return $this
     */
    public function label($label)
    {
        $this->label = $label;

        return $this;
    }


    /**
     * Create form input field for adding meta tags input
     *
     * @param null $value
     * @param array|null $options
     * @param bool $bootstrapped
     * @return mixed
     * @throws \Exception
     */
    public function input($value = null, array $options = null, $bootstrapped = false)
    {

        if ($bootstrapped == true) {
            return '<div class="form-group">
                            <label for="' . isset($options['id']) ? $options['id'] : $this->getName() . '">' .
                            $this->getLabel() . '</label>'
                            . Form::input('text', $this->getName(), $value, isset($options) ? $options: null) . '</div>';
        }

        return Form::input('text', $this->getName(), $value, isset($options) ? $options: null);
    }


    /**
     * Get input label
     *
     * @return string
     * @throws \Exception
     */
    public function getLabel()
    {
        if (!$this->label) {
            throw new \Exception('Input label is not set!');
        }

        return $this->label;
    }


    /**
     * Get input name
     *
     * @return string
     * @throws \Exception
     */
    public function getName()
    {
        if (!$this->name) {
            throw new \Exception('Input label is not set!');
        }

        return $this->name;
    }

}