<?php


function smarty_compiler_remote_widget($arrParams,  $smarty){

    $strResourceApiPath = preg_replace('/[\\/\\\\]+/', '/', dirname(__FILE__) . '/lib/FISPagelet.class.php');
    $strCode = '<?php if(!class_exists(\'FISPagelet\')){require_once(\'' . $strResourceApiPath . '\');}';
    $strName = isset($arrParams['name']) ? $arrParams['name'] : "";
    $strPageletId = $arrParams['pagelet_id'];
    $strRule = $arrParams['rule'];

    if($strPageletId && $strRule){
        $strCode .= 'FISPagelet::registerRemoteWidgetRules($_smarty_tpl->smarty);';
        $strCode .= 'FISPagelet::remote_start(' . $strPageletId . ',' . $strRule . ', $_smarty_tpl->smarty);';
    } else {
        trigger_error('undefined remote widget pagelet_id or rule in file "' . $smarty->_current_file . '"', E_USER_ERROR);
    }

    $strCode .= '?>';
    return $strCode;
}
