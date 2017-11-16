<?php

    // SCSS to CSS compiler
    require "php/scss.inc.php";
    function scsscss($stylesheet) {
        $scss = new scssc;
        try {
            $stylesheet = $scss->compile($stylesheet);
        } catch (Exception $ex) {
            return "scssphp fatal error: \n".$ex->getMessage();
        }
        $stylesheet = preg_replace('/\n+/','',$stylesheet);
        $stylesheet = preg_replace('/\s?+{\s+/','{',$stylesheet);
        $stylesheet = preg_replace('/\s?+;}/','}',$stylesheet);
        $stylesheet = preg_replace('/:\s+/',':',$stylesheet);
        $stylesheet = preg_replace('/;\s+/',';',$stylesheet);
        $stylesheet = preg_replace('/\s+/',' ',$stylesheet);
        return $stylesheet;
    }


    $GLOBALS['flag_preserver'] = true;
    $GLOBALS['puce'] = '-';
    $GLOBALS['class_spip_plus'] = '';
    $GLOBALS['ligne_horizontale'] = '<hr/>';
    $GLOBALS['debut_intertitre'] = '<h3>';
    $GLOBALS['fin_intertitre'] = '</h3>';

    require "api_keys.php";


    function balise_YOUTUBE_API_KEY($p) {
        $p->code = $GLOBALS['youtube_api_key'];
        return $p;
    }
    function balise_SOUNDCLOUD_API_KEY($p) {
        $p->code = 'nocrash_' . $GLOBALS['soundcloud_api_key'];
        return $p;
    }

    function video_id($url) {
        if (strpos($url,'vimeo.com') !== false) {
            return end(explode('.com/',$url));
        }
        else if (strpos($url,'dailymotion.com') !== false) {
            return reset(explode('_',end(explode('/video/',$url))));
        }
        else if (strpos($url,'youtube.com') !== false) {
            return  end(explode('?v=',$url));
        }
        else if (strpos($url,'youtu.be') !== false) {
            return end(explode('.be/',$url));
        }
        else {
            return false;
        }
    }


    $GLOBALS['spip_pipeline']['pre_typo'] .= "|custom_pre_typo";
    function custom_pre_typo($flux) {

        $flux = str_replace('////','<div class="clear"></div>',$flux);
        $flux = preg_replace('/<center>(.*)<\/center>/s','<div class="align-center">$1</div>',$flux);
        $flux = preg_replace('/<right>(.*)<\/right>/s','<div class="align-right">$1</div>',$flux);

        return $flux;

    }
    // Necessite d'ajouter le suffixe _dist à la fonction originale dans plugins/auto/saisies/.../saisies_pipeline.php
    function saisies_affichage_final($flux){
	    return $flux;
    }

    $GLOBALS['spip_pipeline']['header_prive'] .= "|add_custom_style";
    function add_custom_style($flux){
        $flux .= '<link rel="stylesheet" href="'. find_in_path("fonts/font-awesome.min.css") .'" />';
        $flux .= '<link rel="stylesheet" href="'. find_in_path("fonts/fonts.css") .'" />';
        $flux .= '<link rel="stylesheet" href="'. generer_url_public("styles_prive.css") .'" />';
        return $flux;
    }

    // bandcamp album id retreiver
    function bandcamp_album_id($url) {

        $content = file_get_contents($url, false, null, -1);

        if (preg_match('/<!-- album id ([0-9]*) -->/UimsS', $content, $match)) {

            if (isset($match[1])) {
                return $match[1];
            } else {
                return false;
            }

        } else {

            return false;

        }

    }

?>
