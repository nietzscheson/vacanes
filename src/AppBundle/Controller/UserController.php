<?php

namespace AppBundle\Controller;

use AppBundle\Controller\APIRestBaseController;
use AppBundle\Controller\TokenAuthenticatedController;
use AppBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserController extends APIRestBaseController implements TokenAuthenticatedController
{

    public function userUpdateAction(Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $user = $request->attributes->get('user');

        $userForm = $this->createForm(new UserType(), $user)->handleRequest($request);

        if($userForm->isValid()){

            $em->persist($user);
            $em->flush();

            return $this->apiResponse($user)->groups(array('user'))->response();
        }

        return $this->apiResponse($userForm->getErrorsAsString())->groups(array('user'))->response();
    }

    public function userDeleteAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $request->attributes->get('user');

        $em->remove($user);
        $em->flush();

        return $this->apiResponse(array('User removed'))->response();

    }

}
