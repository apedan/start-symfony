<?php

namespace Learn\Bundle\GBookBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/post/create');

        $newPostTheme = 'Theme text';
        $newPostText= 'Post text';

        $form = $crawler->selectButton('post[submit]')->form();

        $form['post[theme]'] = $newPostTheme;
        $form['post[text]'] = $newPostText;

        $client->submit($form);

        $this->assertTrue(
            $client->getResponse()->isRedirect('/')
        );
    }

    public function testPosts()
    {
        $client = static::createClient();
        $client->request('GET', '/posts');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }

    public function testIndex()
    {
        $client = static::createClient();

        $client->request('GET', '/');
        $this->assertTrue($client->getResponse()->isSuccessful());
    }
}
