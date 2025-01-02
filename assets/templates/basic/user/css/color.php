<?php
header("Content-Type:text/css");
function checkhexcolor($color) {
    return preg_match('/^#[a-f0-9]{6}$/i', $color);
}
if (isset($_GET['color']) AND $_GET['color'] != '') {
    $color = "#" . $_GET['color'];
}

if (!$color OR !checkhexcolor($color)) {
    $color = "#336699";
}

if (isset($_GET['secondColor']) AND $_GET['secondColor'] != '') {
    $secondColor = "#" . $_GET['secondColor'];
}

if (!$secondColor OR !checkhexcolor($secondColor)) {
    $secondColor = "#336699";
}

?>

.btn--base,.dashboard-overview__header,span.templete-social-icon,.btn--base:hover,.pagination .page-item.active .page-link,.bg--base{
    background-color:<?php echo $color; ?>
}
.subscribe-templete-view a:hover,.robot-name span,.text--base{
    color:<?php echo $color; ?>
}
.template-card-icon{
    background:<?php echo $color; ?>
}
.download-btn{
    border: 1px solid<?php echo $color; ?>;
    color: <?php echo $color; ?>;
}
.sidebar-menu__item.active .sidebar-menu__link,.d-sidebar.rounded .sidebar-menu .sidebar-menu__link:hover{
    background-color:<?php echo $color; ?>17
}