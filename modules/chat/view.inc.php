<?php
class Chat_View
{
    public function MessagesList($messagesList) {
        $messagesTPL = new Template("template/chat/messages.tpl");
        $messagesTPL->SetParams($messagesList);
        return $messagesTPL->GetHTML();
    }
}