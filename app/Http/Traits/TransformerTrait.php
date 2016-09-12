<?php

namespace App\Http\Traits;

trait TransformerTrait
{
    /**
     * Create a new instance of the transformer.
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function createTransformer()
    {
        $transformer = '\\'.ltrim($this->transformer, '\\');

        return new $transformer;
    }

    /**
     * Returns the transformer.
     *
     * @return string
     */
    public function getTransformer()
    {
        return $this->transformer;
    }

    /**
     * Runtime override of the transformer.
     *
     * @param  string  $transformer
     * @return self
     */
    public function setTransformer($transformer)
    {
        $this->transformer = $transformer;

        return $this;
    }
}
