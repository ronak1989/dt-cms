    <meta charset="utf-8">
    <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo $metaTags['title'];?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo _CONST_CSS_PATH;?>styles.css">
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo _CONST_CSS_PATH;?>queries.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- <link rel="canonical" href="/items?page=3" /> -->
    <?php if ($data['next_url'] != '') {?>
    <link rel="next" href="<?php echo $data['next_url']?>"/>
    <?php }
?>
    <?php if ($data['prev_url'] != '') {?>
    <link rel="prev" href="<?php echo $data['prev_url']?>"/>
    <?php }
?>
    <script src="<?php echo _CONST_JS_PATH;?>modernizr-2.8.3-respond-1.4.2.min.js"></script>
