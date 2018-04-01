<?php

namespace App;

class Log extends BaseModel
{
    public function eventName()
    {
        switch ($this->event) {
            case 'no-identity':
                return 'sikertelen azonosítás';
            case 'indefinite-enter':
                return 'kétséges azonosítás';
            case 'valid-enter':
                return 'sikeres azonosítás';
            case 'selected-enter':
                return 'kiválasztott belépés';
        }

        return 'ismeretlen';
    }

    public function niceComment()
    {
        $comment = $this->comment;

        $pattern = '/([a-z0-9\-]+):([0-9]+);/';
        $replacement = '<a href="participants/${1}">${1}</a><span class="divider" />${2} %<br/>';
        $comment = preg_replace($pattern, $replacement, $comment);
        return $comment;
    }

    public function niceParticipant()
    {
        $id = $this->participant_id;
        return "<a href=\"participants/$id\">$id</a>";
    }
}
