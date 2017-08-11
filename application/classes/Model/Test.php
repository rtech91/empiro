<?php defined('SYSPATH') or die('No direct script access.');

class Model_Test extends Model {
    public static function validateInitialData($data){
        $mh = MessageHandler::getInstance();
        $is_correct = true;
        if(!Valid::not_empty($data->name)){
            $mh->registerMessage('Name is empty!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!Valid::max_length($data->name, 32)){
            $mh->registerMessage('Max name length is 32 symbols!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!empty($data->name) && preg_match('/[\W]/', $data->name)){
            $mh->registerMessage('Not allowed to use anything but letters, numbers and underscores in name!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!Valid::not_empty($data->category)){
            $mh->registerMessage('Category is empty!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!Valid::max_length($data->category, 16)){
            $mh->registerMessage('Max category length is 16 symbols!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!empty($data->category) && preg_match('/[\W]/', $data->category)){
            $mh->registerMessage('Not allowed to use anything but letters, numbers and underscores!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!Valid::not_empty($data->total_time)){
            $mh->registerMessage('Total time is empty!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!Valid::max_length($data->total_time, 3)){
            $mh->registerMessage('Max total time length is 3 symbols!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!empty($data->total_time) && !Valid::digit($data->total_time, true)){
            $mh->registerMessage('Not allowed to use anything but numbers in total time!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!Valid::not_empty($data->min_right_answers)){
            $mh->registerMessage('Minimum right answers is empty!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!Valid::max_length($data->min_right_answers, 2)){
            $mh->registerMessage('Max minimum right answers length is 2 symbols!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        if(!empty($data->min_right_answers) && !Valid::digit($data->min_right_answers, true)){
            $mh->registerMessage('Not allowed to use anything but numbers in minimum right answers!', (MessageHandler::MH_ERROR | MessageHandler::ACCESS_ADMIN));
            $is_correct = false;
        }
        return $is_correct;
    }
}