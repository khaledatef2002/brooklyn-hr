<?php

namespace App\Enum;

enum NotificationEntityType: string
{
    case TASK = 'task';
    case TASK_MESSAGE = 'task_message';
    case INTERNSHIP_REQUEST = 'internship_request';
}
