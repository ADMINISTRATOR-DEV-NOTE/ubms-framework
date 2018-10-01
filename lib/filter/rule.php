<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

// 웹사이트에서 다운받아 적당한 곳에 압축 푸세요.
include_once 'htmlpurifier-4.8.0/library/HTMLPurifier.auto.php';
global $filterConfig;




// 기본 설정을 불러온 후 적당히 커스터마이징을 해줍니다.
$filterConfig = HTMLPurifier_Config::createDefault();
$filterConfig->set('Attr.EnableID', false);
$filterConfig->set('Attr.DefaultImageAlt', '');


// 인터넷 주소를 자동으로 링크로 바꿔주는 기능
$filterConfig->set('AutoFormat.Linkify', true);

// 이미지 크기 제한 해제 (한국에서 많이 쓰는 웹툰이나 짤방과 호환성 유지를 위해)
$filterConfig->set('HTML.MaxImgLength', null);
$filterConfig->set('CSS.MaxImgLength', null);

// 다른 인코딩 지원 여부는 확인하지 않았습니다. EUC-KR인 경우 iconv로 UTF-8 변환후 사용하시는 게 좋습니다.
$filterConfig->set('Core.Encoding', 'UTF-8');

// 필요에 따라 DOCTYPE 바꿔쓰세요.
$filterConfig->set('HTML.Doctype', 'XHTML 1.0 Transitional');






// 플래시 삽입 허용
$filterConfig->set('HTML.FlashAllowFullScreen', true);
$filterConfig->set('HTML.SafeEmbed', true);
$filterConfig->set('HTML.SafeIframe', true);
$filterConfig->set('HTML.SafeObject', true);
$filterConfig->set('Output.FlashCompat', true);

$filterConfig->set('URI.SafeIframeRegexp', '#^(?:https?:)?//(?:' . implode('|', array(
            'www\\.youtube(?:-nocookie)?\\.com/',
            'www\\.youtube\\.com/',
            'maps\\.google\\.com/',
            'player\\.vimeo\\.com/video/',
            'www\\.microsoft\\.com/showcase/video\\.aspx',
            '(?:serviceapi\\.nmv|player\\.music)\\.naver\\.com/',
            '(?:api\\.v|flvs|tvpot|videofarm)\\.daum\\.net/',
            'v\\.nate\\.com/',
            'play\\.mgoon\\.com/',
            'channel\\.pandora\\.tv/',
            'www\\.tagstory\\.com/',
            'play\\.pullbbang\\.com/', 'www\\.mgoon\\.com/',
            'tv\\.seoul\\.go\\.kr/',
            'ucc\\.tlatlago\\.com/',
            'vodmall\\.imbc\\.com/',
            'www\\.liveleak\\.com/',
            'www\\.musicshake\\.com/',
            'www\\.afreeca\\.com/player/Player\\.swf',
            'static\\.plaync\\.co\\.kr/',
            'video\\.interest\\.me/',
            'player\\.mnet\\.com/',
            'sbsplayer\\.sbs\\.co\\.kr/',
            'img\\.lifestyler\\.co\\.kr/',
            'c\\.brightcove\\.com/',
            'www\\.slideshare\\.net/',
            'WWW\\.twitch\\.tv/',
            'bgmstore\\.net/',
            'www\\.bgmstore\\.net/'
        )) . ')#');



