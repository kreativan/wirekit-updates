<?php namespace ProcessWire; 
head([
  "js" => [$modules->get("WireKit")->module_url."/listjs/dist/list.min.js"],
  "meta" => [
    "title" => "WireKit: SVG Icons",
  ]
]);

$folders = [];
$folders_ass = array_filter(glob($config->paths->ass."svg/*"), 'is_dir');
$folders_lib = array_filter(glob($config->paths->lib."svg/*"), 'is_dir');
$folders_all = array_merge($folders_ass, $folders_lib);

$vendor_icons = glob($config->paths->lib . "svg/*.svg");
$custom_icons = glob($config->paths->ass . "svg/*.svg");
?>

<main class="uk-section">
<div class="uk-container">

<h1 class="uk-text-center">SVG</h1>

<div id="icon-list">

  <div class="uk-text-center uk-width-1-2@m uk-margin-auto uk-margin-medium-bottom">
    <input class="search uk-input uk-text-center"
      placeholder="Type to search..."
    />
  </div>

  <ul class="list uk-grid" uk-grid>

    <!-- Custom Icons -->
    <?php if(count($custom_icons) > 0) : ?>
      <li class="uk-width-1-1">
        <h3 class="uk-heading-divider">Custom</h3>
      </li>
      <?php foreach($custom_icons as $svg) : ?>
      <li class="uk-width-auto uk-grid-margin uk-text-center">
        <?php
          $svg = str_replace(".svg", "", basename($svg));
          svg($svg, [
            "size" => "32px",
            "color" => "#444"
          ]);
        ?>
        <div class="name uk-text-small">
          <?= $svg ?>
        </div>
      </li>
      <?php endforeach; ?>
    <?php endif;?>

    <!-- Vendor Icons -->
    <?php if(count($vendor_icons) > 0) : ?>
      <li class="uk-width-1-1">
        <h3 class="uk-heading-divider">Vendor</h3>
      </li>
      <?php foreach($vendor_icons as $svg) : ?>
      <li class="uk-width-auto uk-grid-margin uk-text-center">
        <?php
          $svg = str_replace(".svg", "", basename($svg));
          svg($svg, [
            "size" => "32px",
            "color" => "#444"
          ]);
        ?>
        <div class="name uk-text-small">
          <?= $svg ?>
        </div>
      </li>
      <?php endforeach; ?>
    <?php endif;?>

     <!-- Folders -->
    <?php foreach($folders_all as $folder) :?>

      <?php
        $svg_files = glob("$folder/*.svg");
      ?>

      <li class="uk-width-1-1 uk-grid-margin">
        <h3 class="uk-heading-divider"><?= ucfirst(basename($folder)) ?></h3>
      </li>

      <?php foreach($svg_files as $svg) : ?>
      <li class="uk-width-auto uk-grid-margin uk-text-center">
        <?php
          $svg = str_replace(".svg", "", basename($svg));
          $svg = basename($folder) ."/".$svg;
          svg($svg, [
            "size" => "32px",
            "color" => "#444"
          ]);
        ?>
        <div class="name uk-text-small">
          <span><?= $svg ?></span>
        </div>
      </li>
      <?php endforeach;?>

    <?php endforeach; ?>
  </ul>
  
</div>

</div>
</main>

<script>
window.addEventListener("DOMContentLoaded", function() {
  var options = {
    valueNames: [ 'name' ]
  };
  var iconList = new List('icon-list', options);
})
</script>

<?php foot(); ?>