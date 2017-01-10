<?
$crumbs = explode("/",$_SERVER["REQUEST_URI"]);

$crumbs = array_filter($crumbs);

$result = array(); $path = '';
$count = count($crumbs);
foreach($crumbs as $k=>$crumb){
    $path .= '/' . $crumb;
    $name = ucfirst(str_replace(array(".php","_"),array(""," "), $crumb));
    if($k != $count){
        $result[] = "<a href=\"$path\">$name</a>";
    } else {
        $result[] = $name;
    }
}
echo implode(' / ', $result);
?>