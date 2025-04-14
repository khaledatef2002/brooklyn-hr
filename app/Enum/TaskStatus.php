<?php

namespace App\Enum;

enum TaskStatus: string
{
    case NEW = 'new';
    case WORKING = 'working';
    case REVIEW = 'review';
    case FEEDBACK = 'feedback';
    case DONE = 'done';
}
