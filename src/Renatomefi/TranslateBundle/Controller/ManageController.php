<?php

namespace Renatomefi\TranslateBundle\Controller;

use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Renatomefi\TranslateBundle\Document\Language;
use Renatomefi\TranslateBundle\Document\Translation;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\Debug\Debug;
use Symfony\Component\HttpFoundation\Request;

class ManageController extends FOSRestController
{
    /**
     *
     * @Rest\QueryParam(name="key")
     * @Rest\QueryParam(name="value")
     *
     * @Rest\Post("/key/{lang}")
     *
     * @param ParamFetcher $paramFetcher
     *
     * @return View
     */
    public function postKeyAction(ParamFetcher $paramFetcher, Request $request, $lang)
    {
        $languageDM = $this->get('doctrine_mongodb')->getRepository('TranslateBundle:Language');
        $language = $languageDM->findOneBy(array('key' => $lang));

        if (!$language) {
            throw $this->createNotFoundException('Language not found: ' . $lang);
        }
        $dm = $this->get('doctrine_mongodb')->getManager();

        \Doctrine\Common\Util\Debug::dump(json_decode($request->getContent(),true));
        \Doctrine\Common\Util\Debug::dump($paramFetcher->all());
        $translation = new Translation();
        $translation->setLanguage($language);
        $translation->setKey($paramFetcher->get('key'));
        $translation->setValue($paramFetcher->get('value'));

        \Doctrine\Common\Util\Debug::dump($translation);
        $dm->persist($translation);
        $dm->flush();

        \Doctrine\Common\Util\Debug::dump($translation);

        $view = $this->view($translation);

        return $this->handleView($view);

    }

    public function getKeysAction($lang)
    {
        $view = $this->view(['lang' => $lang, 'keys' => ['a', 'b', 'c']], 200);

        return $this->handleView($view);
    }

    /**
     * @Rest\Get("/{lang}/key/{key}")
     */
    public function getKeyAction($lang, $key)
    {
        $view = $this->view(['lang' => $lang, 'key' => $key], 200);

        return $this->handleView($view);

    }

    public function deleteKeyAction($lang, $key)
    {
        $user = $this->get('security.context')->getToken()->getUser();
    }

    public function getLangsAction()
    {
        $dm = $this->get('doctrine_mongodb')->getRepository('TranslateBundle:Language');
        $languages = $dm->findAll();

        if (!$languages) {
            throw $this->createNotFoundException('There are no languages');
        }

        $view = $this->view($languages);

        return $this->handleView($view);

    }

    public function getLangAction($lang)
    {
        $dm = $this->get('doctrine_mongodb')->getRepository('TranslateBundle:Language');
        $language = $dm->findOneBy(array('key' => $lang));

        if (!$language) {
            throw $this->createNotFoundException('Language not found: ' . $lang);
        }

        $view = $this->view(['lang' => $language]);

        return $this->handleView($view);
    }
}
