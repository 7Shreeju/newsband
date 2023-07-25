
<?php if ($page == 'Product' || $page == 'Service') { ?>
    <title> <?php echo $title; ?></title>         
    <meta name="description" content="<?php echo $metadescription; ?>">
    <link rel="canonical" href="<?php echo $canonical; ?>">


    <meta property="og:title" content="<?php echo $title; ?>" />
    <meta property="og:description" content="<?php echo $metadescription; ?>." />
    <meta property="og:image" content="<?php echo $image_url; ?>"  alt="<?php echo $alt_main_img; ?>" />
    <meta property="og:url" content="<?php echo $canonical; ?>" />

<?php
} else {
        foreach ($user_detail as $value) :
            ?>
  
            <title><?php echo $page . '|' .  $value['metatitle'];?></title>       

            <meta name="description" content="<?php echo $value['metades']; ?>">    
            <link rel="canonical" href="<?php echo 'https://digiosolutions.com' . $_SERVER['REQUEST_URI'] ?>" />
            <meta property="og:title" content="<?php echo $title; ?>" />
            <meta property="og:description" content="<?php echo $value['metades']; ?>" />
            <meta name="keywords" content="<?php echo $value['metatitle']; ?>">

            <?php
        endforeach;
    
}
?>



