<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\ExampleModelInterface;

class ExampleTransformer extends TransformerAbstract
{
    /**
     * Turn item into generic array.
     *
     * @param  ContactInterface  $contact
     * @return array
     */
    public function transform(ExampleModelInterface $example)
    {
        return [
            'test' => $example->getTest(),
        ];
    }
}
