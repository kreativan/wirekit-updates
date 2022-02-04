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


<div style="max-width: 1100px; margin: 50px auto; padding: 0 15px;">

<h1 style="margin:0;line-height:1;">SVG</h1>

<div id="icon-list">


  <div style="margin: 30px auto;">
    <input class="search"
      style="height: 32px;width:100%;max-width: 400px;"
      placeholder="Type to search..."
    />
  </div>

  <div class="list" style="display: flex; flex-wrap: wrap; flex:auto; margin-top:30px;">

    <!-- Custom -->
    <?php if(count($custom_icons) > 0) : ?>
      <div style="width: 100%;margin-top: 20px;">
        <h3>Custom</h3>
      </div>
      <?php foreach($custom_icons as $svg) : ?>
      <div style="margin: 0 20px 30px 0;text-align:center;overflow:hidden;">
        <?php
          $svg = str_replace(".svg", "", basename($svg));
          svg($svg, [
            "size" => "32px",
            "color" => "#444"
          ]);
        ?>
        <div class="name" style="font-size: 0.85rem;">
          <?= $svg ?>
        </div>
      </div>
      <?php endforeach; ?>
    <?php endif;?>

    <!-- Vendor -->
    <?php if(count($vendor_icons) > 0) : ?>
      <div style="width: 100%;margin-top: 20px;">
        <h3>Vendor</h3>
      </div>
      <?php foreach($custom_icons as $svg) : ?>
      <div style="margin: 0 20px 30px 0;text-align:center;overflow:hidden;">
        <?php
          $svg = str_replace(".svg", "", basename($svg));
          svg($svg, [
            "size" => "32px",
            "color" => "#444"
          ]);
        ?>
        <div class="name" style="font-size: 0.85rem;">
          <?= $svg ?>
        </div>
      </div>
      <?php endforeach; ?>
    <?php endif;?>

    <?php foreach($folders_all as $folder) :?>

      <?php
        $svg_files = glob("$folder/*.svg");
      ?>

      <div style="width: 100%;margin-top: 20px;">
        <h3><?= ucfirst(basename($folder)) ?></h3>
      </div>

      <?php foreach($svg_files as $svg) : ?>
      <div style="margin: 0 20px 30px 0;text-align:center;overflow:hidden;">
        <?php
          $svg = str_replace(".svg", "", basename($svg));
          $svg = basename($folder) ."/".$svg;
          svg($svg, [
            "size" => "32px",
            "color" => "#444"
          ]);
        ?>
        <div class="name" style="font-size: 0.85rem;">
          <span><?= $svg ?></span>
        </div>
      </div>
      <?php endforeach;?>

    <?php endforeach; ?>
  </div>
  
</div>

</div>

<script>
window.addEventListener("DOMContentLoaded", function() {
  var options = {
    valueNames: [ 'name' ]
  };
  var iconList = new List('icon-list', options);
})
</script>

<?php foot(); ?>