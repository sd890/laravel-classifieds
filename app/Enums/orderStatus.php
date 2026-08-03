<?php
namespace App\Enums;
enum orderStatus:string{
    case Received = 'received';
    case Rejected = 'rejected';
    case Processing = 'processing';

    case Send = 'send';
}

?>