<?php
include_once '../app/view/header/header_common.php';
?>

<!-- BEGIN PAGE LEVEL STYLES -->
<script src="/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<!--<script src="/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>-->


<!-- END PAGE LEVEL STYLES -->

<!-- BEGIN THEME STYLES -->
<link href="/assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
<link href="/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
<link href="/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
<link id="style_color" href="/assets/admin/layout/css/themes/blue.css" rel="stylesheet" type="text/css"/>
<link href="/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>
<link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
<!-- END THEME STYLES -->


<link rel="shortcut icon" href="/favicon.ico"/>
<script type="text/javascript" src="/js/abetterbrowser.js"></script>
<?php
if ($this->env == 'PROD') {
    include_once("/inc/gatracking.php");
}
?>
</head>

<?php
include_once '../app/view/header/header_menu.php';
?>




