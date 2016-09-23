<?php

namespace App\Http\Transformers;

use League\Fractal\TransformerAbstract;
use Delta\DeltaVerification\Users\UserInterface;

class UserTransformer extends TransformerAbstract
{
    /**
     * Turn item into generic array.
     *
     * @param  ContactInterface  $contact
     * @return array
     */
    public function transform(UserInterface $user)
    {
        return [
            'email'          => $user->getEmail(),
            'name'           => $user->getName(),
            'remember_token' => $user->getRememberToken(),
        ];
    }
}
