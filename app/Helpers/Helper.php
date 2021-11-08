<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class Helper
{
    /**
     * for check single permission
     *
     * @param string $permission [single permission check]
     * @return boolean
     * @date 17-09-2021 
     * @author Yatin Bhanderi <yatin.inexture@gmail.com> 
     */
    public static function hasPermission($permission = '')
    {
        if(!$permission || !Auth::check()) {return false;}

        return (Auth::user()->hasDirectPermission($permission) || Auth::user()->hasPermission($permission));
    }
    /**
     * user for multiple permissions
     *
     * @param array $permissions [list of permissions]
     * @return boolean
     * @date 17-09-2021 
     * @author Yatin Bhanderi <yatin.inexture@gmail.com> 
     */
    public static function hasAnyPermission($permissions = [])
    {
        if (!$permissions || !Auth::check()) {return false;}

        return (Auth::user()->hasAnyDirectPermission($permissions) || Auth::user()->hasAnyPermission($permissions));
    }

    /**
     * For make the filter array for
     *
     * @param [type] $filed_name
     * @param string $operator
     * @param [type] $value
     * @return array
     * @date 20-09-2021 
     * @author Yatin Bhanderi <yatin.inexture@gmail.com> 
     */
    public static function makeFilter($filed_name, $operator, $value)
    {
        if(empty($value)) { return  []; }
        if(empty($operator)) { $operator = '='; }

        return ['field' => $filed_name, 'operator' => $operator, 'value' => $value];
    }

    public static function ajaxFillDropdown($parent_ele, $child_ele, $url,$clear_dropdowns = [])
    {
        return view('common.dependant-dropdown', compact('parent_ele', 'child_ele', 'url', 'clear_dropdowns'))->render();
    }

    public static function getDateFormat($date)
    {
        if(empty($date) || $date == '0000-00-00'){
            return;
        }
        return \Carbon\Carbon::parse($date)->format('d-m-Y');
    }

    public static function setDateFormat($date)
    {
        if (empty($date) || $date == '0000-00-00') {
            return;
        }
        return \Carbon\Carbon::parse($date)->format('Y-m-d');
    }

    public static function getDateTimeFormat($date)
    {

        return \Carbon\Carbon::parse($date)->format('Y-m-d H:m:s');
    }
}
