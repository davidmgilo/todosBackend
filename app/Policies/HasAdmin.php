<?php
/**
 * Created by PhpStorm.
 * User: alumne
 * Date: 13/12/16
 * Time: 21:41
 */

namespace Davidmgilo\TodosBackend\Policies;


trait HasAdmin
{

    public function before($user, $ability)
    {
        if($user->hasRole('admin')) return true;
    }

}