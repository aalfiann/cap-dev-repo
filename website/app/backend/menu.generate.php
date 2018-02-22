<?php

function generateMenuJson($menujson){
    $result = "";
    if(empty($menujson)) return $result;
    $menu = json_decode($menujson);
    if(json_last_error() != JSON_ERROR_NONE) return $result;
    foreach($menu->menu as $menuval){
        $result .= '<li class="nav-small-cap">'.strtoupper($menuval->header).'</li>';
        foreach($menuval->subheader as $subvalue){
            $dataresult='';
            $n=0;
            $menuli='';
            foreach($subvalue->menus as $menuvalue){
                if (!empty($menuvalue->submenus)){
                    $sn=0;
                    $menulisub='';
                    foreach ($menuvalue->submenus as $menuvaluesub){
                        $menulisub .= '<li><a href="'.$menuvaluesub->link.'">'.ucwords($menuvaluesub->title).' </a></li>';
                        $sn++;
                    }
                    $menuli .= '<li><a class="has-arrow" href="#">'.ucwords($menuvalue->title).''.(!empty($menuvalue->label_class)?' <span class="'.$menuvalue->label_class.'">'.$sn.'</span>':'').'</a>';
                    $menulisubs = '';
                    if ($sn>0){
                        $menulisubs .= '<ul aria-expanded="false" class="collapse">';
                        $menulisubs .= $menulisub;
                        $menulisubs .= '</ul>';
                        $menulisubs .= '</li>';
                    }
                    $menuli .= $menulisubs;
                } else {
                    $menuli .= '<li><a href="'.$menuvalue->link.'">'.ucwords($menuvalue->title).' </a></li>';
                }
                $n++;
            }
            if ($n > 0){           
                $dataresult .= '<li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><i class="'.$subvalue->icon_class.'"></i><span class="hide-menu">'.ucwords($subvalue->title).''.(!empty($subvalue->label_class)?' <span class="'.$subvalue->label_class.'">'.$n.'</span>':'').'</span></a>';
                $dataresult .= '<ul aria-expanded="false" class="collapse">';
                $dataresult .= $menuli;
                $dataresult .= '</ul>';
            }
            
            $result .= $dataresult;
        }
    }
    return $result;
}

$datamenu = file_get_contents('menu.all.json');
echo generateMenuJson($datamenu);
?>