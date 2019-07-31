<?php

/**
 * Loads public style sheets according to the subdomain.
 *
 * @return string
 */
function publicStylesheet()
{
    $link           = "<link href='%s' rel='stylesheet'>";
    $baseStyleSheet = sprintf($link, asset('/css/style.min.css'));
    $faviconLink    = sprintf('<link rel="shortcut icon" type="image/png" sizes="32*32" href="%s"/>', asset('/images/favicon-tz.png'));


    if (isTzSubDomain()) {
        $styleSheet = sprintf($link, asset('/tz/css/tz.min.css'));

        return $faviconLink . $baseStyleSheet . $styleSheet;
    } else {
        //$faviconLink = sprintf('<link rel="shortcut icon" type="image/png" sizes="32*32" href="%s"/>', '/images/favicon.png');
        $faviconLink = '<link rel="shortcut icon" type="image/png" sizes="16*16" href="images/devflow/favicon.png"/>
        <link rel="apple-touch-icon" sizes="57x57" href="/images/devflow/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/images/devflow/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/images/devflow/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/images/devflow/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/images/devflow/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/images/devflow/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/images/devflow/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/images/devflow/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/images/devflow/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192" href="/images/devflow/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/images/devflow/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/images/devflow/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/images/devflow/favicon-16x16.png">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="/images/devflow/ms-icon-144x144.png">';
        return $faviconLink . $baseStyleSheet;
    }
}

/**
 * Loads style sheets for all authenticated routes according to the subdomain.
 *
 * @return string
 */
function authStyleSheets()
{
    $link           = "<link href='%s' rel='stylesheet'>";
    $baseStyleSheet = sprintf($link, asset('/lite/css/lite.min.css'));
    $faviconLink = "<link rel='shortcut icon' type='image/png' sizes='32*32' href='%s'/>";

    if (isTzSubDomain()) {
        $styleSheet = sprintf($link, asset('/tz/css/tz.min.css'));
        $favicon = sprintf($faviconLink, asset('/images/favicon-tz.png'));

        return $favicon . $baseStyleSheet . $styleSheet;
    } else {
        $favicon = sprintf($faviconLink, asset('/images/favicon.png'));

        return $favicon . $baseStyleSheet;
    }
}