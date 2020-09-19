<?php

namespace App\Controller;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class AdminUserController extends EasyAdminController
{
    /**
     * Variable $this->encoder.
     *
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    /**
     * Variable  $this->role.
     *
     * @var [type]
     */

    private $role;

    /**
     * Void __construct().
     *
     * @param UserPasswordEncoderInterface $encoder comment
     */
    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
        //  $this->role = $role;
    }

    private function _setUserPassword(User $user): void
    {
        if ($user->getPlainPassword() !== null) {
            $user->setPassword($this->encoder->encodePassword($user, $user->getPlainPassword()));
        }
    }

    public function persistUserEntity(User $user): void
    {
        $this->_setUserPassword($user);
        $this->persistEntity($user);
    }


    private function _setUserRoles(User $user): void
    {
        // dd($user);
        $role = $user->getRoles();
        //dd($role);

        if (null !== $user->getRoles() && !in_array($role, $user->getRoles())) {
            $user->setRoles(array($role));

            // $user->setToken('');
        }
    }

    public function updateUserEntity(User $user): void
    {
        $this->_setUserPassword($user);
        $this->updateEntity($user);
    }
}
