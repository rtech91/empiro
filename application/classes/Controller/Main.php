<?php defined('SYSPATH') or die('No direct script access.');

class Controller_Main extends Controller
{

    private $tests;

    public function before()
    {
        $storage = Model_Storage::getInstance();
        $this->tests = $storage->getAllAvailableTests();
    }

    public function action_index()
    {
        $tests = array();
        if (null !== $this->tests && count($this->tests) > 0) {
            $tests = $this->tests;
        }
        $messages = MessageHandler::getInstance()->getMessages();
        $view = new View('layout');
        $view->header = new View('header');
        $view->content = new View('front');
        $view->content->messages = $messages;
        $view->content->tests = $tests;
        $view->footer = new View('footer');
        $this->response->body($view->render());
    }

    public function action_contacts()
    {
        if ($this->request->method() === Request::POST) {
            $data = (object)filter_var_array($_POST, FILTER_SANITIZE_STRING);
            // additionally remove dangerous symbols from email value
            $data->contact_email = filter_var($data->contact_email, FILTER_SANITIZE_EMAIL);
            //TODO: add reaction handling for exception situations,
            // such as empty input text or wrong message category
            Model_Mail::sendContactMail($data);
        }

        $messages = MessageHandler::getInstance()->getMessages();
        $view = new View('layout');
        $view->header = new View('header');
        $view->content = new View('contact');
        $view->content->messages = $messages;
        $view->footer = new View('footer');
        $this->response->body($view->render());
    }
} // End Main
