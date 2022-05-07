<?php
define('API_KEY','توکن');
//----######------
function ali($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,http_build_query($datas));
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
$result=json_decode($message,true);
//_
$update = json_decode(file_get_contents('php://input'));
var_dump($update);
//=========
$chat_id = $update->message->chat->id;
$message_id = $update->callback_query->message->message_id;
$from_id = $update->message->from->id;
$chat_id = $update->message->chat->id;
$textmessage = isset($update->message->text)?$update->message->text:'';
$reply = $update->message->reply_to_message->forward_from->id;
$sticker = $update->message->sticker;
$text = $update->message->text;
$result = json_decode($message,true);
//_______
function SendMessage($ChatId, $TextMsg)
{
 ali('sendMessage',[
'chat_id'=>$ChatId,
'text'=>$TextMsg,
'parse_mode'=>"MarkDown"
]);
}
function SendAction($chat_id, $action){
	ali('SendChatAction',[
	'chat_id'=>$chat_id,
	'action'=>$action
	]);
	}
	function sendphoto($ChatId, $photo_id,$caption)
{
    ali('sendphoto',[
        'chat_id'=>$ChatId,
        'photo'=>$photo_id,
        'caption'=>$caption
    ]);
}
function sendvideo($chat_id,$video_id,$caption){
    ali('sendvideo',[
        'chat_id'=>$ChatId,
        'video'=>$video_id,
        'caption'=>$caption
    ]);
}
function sendaudio($chat_id,$audio_id,$caption){
    ali('sendaudio',[
        'chat_id'=>$ChatId,
        'audio'=>$audio_id,
        'caption'=>$caption
    ]);
}
function sendaoice($chat_id,$voice_id,$caption){
    ali('sendaoice',[
        'chat_id'=>$ChatId,
        'voice'=>$audio_id,
        'caption'=>$caption
    ]);
}
function senddocument($chat_id,$document_id,$caption){
    ali('senddocument',[
        'chat_id'=>$ChatId,
        'document'=>$document_id,
        'caption'=>$caption
    ]);
}
function sendsticker($chat_id,$sticker_id,$caption){
    ali('sendsticker',[
        'chat_id'=>$ChatId,
        'sticker'=>$sticker_id,
        'caption'=>$caption
    ]);
}
//====================ᵗᶦᵏᵃᵖᵖ======================//
if($textmessage == "/start"){
    var_dump(ali('sendMessage',[ 
    SendAction($chat_id, typing),
        'chat_id'=>$update->message->chat->id, 
        'text'=>"سلام",
        'parse_mode'=>'MarkDown',
        'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [
                    ['text'=>"سازنده من😊",'url'=>"https://telegram.me/aliesmaieli"],['text'=>"کانال من😎",'url'=>"https://telegram.me/tikapp"]
                ]
            ]
        ])
    ]));
}
elseif(preg_match('/^\/([Oo]therbot)/',$textmessage)){
        ali("forwardmessage", [
                'chat_id' => $Tchat_id,
                'from_chat_id' => "@tikapp",
                'message_id' => 12
            ]);
        }
//====================ᵗᶦᵏᵃᵖᵖ======================//
elseif(preg_match('/^https?:\/\/[^ ]+?(?:\.[a-zA-Z0-9])/',$textmessage,$mat)) {
ali('sendphoto',[
'chat_id'=>$chat_id,
'photo'=>$textmessage,
'caption'=>"عکس شما دانلود شو",
]);
}
elseif(preg_match('/^https?:\/\/[^ ]+?(?:\.mp4)/',$textmessage,$mat)) {
ali('sendvideo',[
'chat_id'=>$chat_id,
'video'=>$textmessage,
'caption'=>"ویدیو شما دانلود شد",
]);
}
elseif(preg_match('/^https?:\/\/[^ ]+?(?:\.[a-zA-Z0-9])/',$textmessage,$mat)) {
ali('sendaudio',[
'chat_id'=>$chat_id,
'audio'=>$textmessage,
'caption'=>"اهنگ شما دانلود شد",
]);
}
elseif(preg_match('/^https?:\/\/[^ ]+?(?:\.[a-zA-Z0-9])/',$textmessage,$mat)) {
ali('senddocument',[
'chat_id'=>$chat_id,
'document'=>$textmessage,
'caption'=>"فایل شما دانلود شد",
]);
}
elseif(preg_match('/^http[Ss]?:\/\/[^ ]+?(?:\.[a-zA-Z0-9])/',$textmessage,$mat)) {
ali('sendsticker',[
'chat_id'=>$chat_id,
'sticker'=>$textmessage,
]);
}
elseif(preg_match('/^https?:\/\/[^ ]+?(?:\.[a-zA-Z0-9])/',$textmessage,$mat)) {
ali('sendvoice',[
'chat_id'=>$chat_id,
'voice'=>$textmessage,
'caption'=>"ویس شما دانلود شد",
]);
}
//====================ᵗᶦᵏᵃᵖᵖ======================//
?>
